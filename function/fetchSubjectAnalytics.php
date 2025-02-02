<?php
include "../connectDb.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$section_id = isset($_POST['section_analytics']) ? (int)$_POST['section_analytics'] : 0;

if ($section_id === 0) {
    echo json_encode(["error" => "Invalid section ID"]);
    exit;
}

$sql = "SELECT tsub.subject_id AS subject_id, sub.subject_name AS subject_name
        FROM teacher_subject tsub
        JOIN subject sub ON tsub.subject_id = sub.subject_id
        JOIN teacher_section ts ON tsub.teacher_id = ts.teacher_id
        WHERE ts.section_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["error" => $conn->error]);
    exit;
}

$stmt->bind_param("i", $section_id);
$stmt->execute();
$result = $stmt->get_result();

$subject = [];
while ($row = $result->fetch_assoc()) {
    $subject[] = $row;
}

header('Content-Type: application/json');
echo json_encode($subject);

$stmt->close();
$conn->close();
?>
 