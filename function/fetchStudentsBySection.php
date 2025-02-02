<?php
require "../connectDb.php";


if (isset($_GET['section_id'])) {
    $section_id = $_GET['section_id'];

    
    $sql = "SELECT student_id, CONCAT(last_name, ', ', first_name, ' ', LEFT(middle_name, 1), '.') AS full_name
            FROM student WHERE section_id = $section_id";
    $result = mysqli_query($conn, $sql);

   
    $students = array();
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }

    
    echo json_encode($students);
} else {
    echo json_encode([]);
}
?>
