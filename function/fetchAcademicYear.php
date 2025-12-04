<?php
require "../connectDb.php";
session_start(); 

    $fetchAcademicyearSql = "SELECT DISTINCT academic_year FROM grade";

    $result = mysqli_query($conn, $fetchAcademicyearSql);

   
    $academicYear = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $academicYear[] = $row; 
        }
    }

   
    echo json_encode($academicYear);
?>
