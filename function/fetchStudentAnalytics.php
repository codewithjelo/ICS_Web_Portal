<?php
include("../connectDb.php");

if (isset($_POST['section_analytics'], $_POST['academic_year_analytics'], $_POST['subject_analytics'])) {
    $sectionId = $_POST['section_analytics'];
    $academicYear = $_POST['academic_year_analytics'];
    $subjectId = $_POST['subject_analytics'];

    $query = "SELECT CONCAT(student.last_name, ', ', student.first_name, ' ', LEFT(student.middle_name, 1), '.') AS full_name,
                CONCAT(student.last_name, ', ', student.first_name) AS full_name_2,
                student.middle_name AS middle_name,
                ROUND(((grade.first_quarter + grade.second_quarter + grade.third_quarter + grade.fourth_quarter) / 4), 2) AS average
            FROM grade    
            JOIN student ON grade.student_id = student.student_id
            WHERE grade.subject_id = ? AND grade.section_id = ? AND grade.academic_year = ?
            ORDER BY average DESC
            LIMIT 10"; // DESC for Top List

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        echo "<tr><td colspan='2' class='text-center'>Error preparing statement</td></tr>";
        exit;
    }

    $stmt->bind_param('iis', $subjectId, $sectionId, $academicYear);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['middle_name'] != NULL) {

                echo "<tr>
                        <td>" . htmlspecialchars($row['full_name']) . "</td>
                        <td>" . number_format($row['average'], 2) . "</td>
                      </tr>";
            } else {
                echo "<tr>
                        <td>" . htmlspecialchars($row['full_name_2']) . "</td>
                        <td>" . number_format($row['average'], 2) . "</td>
                      </tr>";
            }
        }
    } else {
        echo "<tr><td colspan='2' class='text-center'>No data available</td></tr>";
    }

    $stmt->close();
} else {
    echo "<tr><td colspan='2' class='text-center'>Invalid input parameters</td></tr>";
}

$conn->close();
