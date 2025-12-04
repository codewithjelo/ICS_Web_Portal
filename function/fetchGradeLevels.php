<?php

include "../connectDb.php";


$fetchAcademicyearSql = "SELECT grade_level_id, grade_level FROM grade_level";
$result = $conn->query($fetchAcademicyearSql);


$gradeLevels = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $gradeLevels[] = $row;
    }
}


echo json_encode($gradeLevels);


$conn->close();
?>
