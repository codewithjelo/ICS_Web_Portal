<?php
require "../connectDb.php";
session_start();


if (isset($_SESSION['get_user_id'])) {
    $teacherId = $_SESSION['get_user_id'];

    $fetchAcademicyearSql = "SELECT sub.subject_id AS subject_id, sub.subject_name AS subject_name
        FROM subject sub
        JOIN teacher_subject tsub ON tsub.subject_id = sub.subject_id
        WHERE tsub.teacher_id = $teacherId";

    $result = mysqli_query($conn, $fetchAcademicyearSql);

    
    $subjects = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $subjects[] = [
                'subject_id' => $row['subject_id'],
                'subject_name' => $row['subject_name']
            ];
        }
    }

    
    echo json_encode($subjects);
} else {
    echo json_encode([]);
}
?>
