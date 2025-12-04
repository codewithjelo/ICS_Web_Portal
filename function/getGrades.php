<?php
include("../connectDb.php");

header('Content-Type: application/json');

try {
    // Get the POST data
    $sectionId = isset($_POST['section_analytics']) ? $_POST['section_analytics'] : null;
    $academicYear = isset($_POST['academic_year_analytics']) ? $_POST['academic_year_analytics'] : "2022-2023";

    if (!$sectionId || !$academicYear) {
        echo json_encode(['error' => 'Missing section_analytics or academic_year_analytics parameter']);
        exit;
    }

    // SQL query to fetch the data
    $query = "SELECT subject.subject_id, subject.subject_name,
            ROUND(AVG(grade.first_quarter), 2) AS first_quarter_avg,
            ROUND(AVG(grade.second_quarter), 2) AS second_quarter_avg,
            ROUND(AVG(grade.third_quarter), 2) AS third_quarter_avg,
            ROUND(AVG(grade.fourth_quarter), 2) AS fourth_quarter_avg
        FROM grade
        INNER JOIN subject ON grade.subject_id = subject.subject_id
        WHERE grade.section_id = ? AND grade.academic_year = ?
        GROUP BY subject.subject_id, subject.subject_name";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $sectionId, $academicYear);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    $stmt->close();
    $conn->close();
}
?>
