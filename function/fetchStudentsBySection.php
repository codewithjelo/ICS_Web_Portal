<?php
require "../connectDb.php";


if (isset($_GET['section_id'])) {
    $sectionId = $_GET['section_id'];

    
    $fetchAcademicyearSql = "SELECT student_id, CONCAT(last_name, ', ', first_name, ' ', LEFT(middle_name, 1), '.') AS full_name
            FROM student WHERE section_id = $sectionId";
    $result = mysqli_query($conn, $fetchAcademicyearSql);

   
    $students = array();
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }

    
    echo json_encode($students);
} else {
    echo json_encode([]);
}
?>
