<?php
require "../connectDb.php";
session_start(); 


if (isset($_SESSION['get_user_id'])) {
    $teacher_id = $_SESSION['get_user_id'];

    
    $sql = "SELECT s.section_id AS section_id, s.section_name AS section_name
        FROM section s
        JOIN teacher_section ts ON ts.section_id = s.section_id
        WHERE ts.teacher_id = $teacher_id";

    $result = mysqli_query($conn, $sql);

   
    $sections = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sections[] = [
                'section_id' => $row['section_id'],
                'section_name' => $row['section_name']
            ];
        }
    }

    
    echo json_encode($sections);
} else {
    echo json_encode([]); 
}
?>
