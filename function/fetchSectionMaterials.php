<?php
require "../connectDb.php";
session_start(); // Ensure the session is started to access session variables

// Retrieve teacher_id from session
if (isset($_SESSION['get_user_id'])) {
    $teacher_id = $_SESSION['get_user_id'];

    // Query to get sections based on teacher_id
    $sql = "SELECT s.section_id AS section_id, s.section_name AS section_name
        FROM section s
        JOIN teacher_section ts ON ts.section_id = s.section_id
        WHERE ts.teacher_id = $teacher_id";

    $result = mysqli_query($conn, $sql);

    // Prepare an array to hold the results
    $sections = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sections[] = [
                'section_id' => $row['section_id'],
                'section_name' => $row['section_name']
            ];
        }
    }

    // Return the sections as a JSON response
    echo json_encode($sections);
} else {
    echo json_encode([]); // Return empty array if teacher_id is not set
}
?>
