<?php
require "../connectDb.php";
session_start(); 




   
    $sql = "SELECT DISTINCT academic_year FROM grade";

    $result = mysqli_query($conn, $sql);

   
    $academic_year = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $academic_year[] = $row; 
        }
    }

   
    echo json_encode($academic_year);
?>
