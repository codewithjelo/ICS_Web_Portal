<?php
require "../connectDb.php";

// Check if section_id is provided
if (isset($_GET['section_id'])) {
    $section_id = $_GET['section_id'];

    // Query to get students for the specific section
    $sql = "SELECT student_id, CONCAT(last_name, ', ', first_name, ' ', LEFT(middle_name, 1), '.') AS full_name
            FROM student WHERE section_id = $section_id";
    $result = mysqli_query($conn, $sql);

    // Prepare an array to hold the students' data
    $students = array();
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }

    // Return the students as a JSON response
    echo json_encode($students);
} else {
    echo json_encode([]); // Return an empty array if section_id is not set
}
?>
