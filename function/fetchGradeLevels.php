<?php

include "../connectDb.php";


$sql = "SELECT grade_level_id, grade_level FROM grade_level";
$result = $conn->query($sql);


$grade_levels = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $grade_levels[] = $row;
    }
}


echo json_encode($grade_levels);


$conn->close();
?>
