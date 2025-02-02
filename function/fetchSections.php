<?php

include "../connectDb.php";


$grade_level_id = isset($_POST['grade_level_id']) ? (int)$_POST['grade_level_id'] : 0;


$sql = "SELECT section_id, section_name FROM section WHERE grade_level_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $grade_level_id);
$stmt->execute();
$result = $stmt->get_result();


$sections = array();
while ($row = $result->fetch_assoc()) {
    $sections[] = $row;
}


echo json_encode($sections);


$stmt->close();
$conn->close();
?>