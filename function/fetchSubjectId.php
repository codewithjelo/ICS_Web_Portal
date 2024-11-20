<?php
require "../connectDb.php";
session_start(); // Ensure the session is started to access session variables

// Retrieve teacher_id from session
if (isset($_SESSION['get_user_id'])) {
    $teacher_id = $_SESSION['get_user_id'];

    $sql = "SELECT sub.subject_id AS subject_id, sub.subject_name AS subject_name
        FROM subject sub
        JOIN teacher_subject tsub ON tsub.subject_id = sub.subject_id
        WHERE tsub.teacher_id = $teacher_id";

    $result = mysqli_query($conn, $sql);

    // Prepare an array to hold the results
    $subjects = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $subjects[] = [
                'subject_id' => $row['subject_id'],
                'subject_name' => $row['subject_name']
            ];
        }
    }

    // Return the sections as a JSON response
    echo json_encode($subjects);
} else {
    echo json_encode([]);
}
?>
