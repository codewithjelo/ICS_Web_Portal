<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../connectDb.php");

$sql = "SELECT * FROM schedule_list";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

$schoolEvents = [];
while ($schoolDate = mysqli_fetch_assoc($result)) {
    $schoolEvents[] = [
        'title' => $schoolDate['title'],
        'start' => date('c', strtotime($schoolDate['start_datetime'])),
        'end' => date('c', strtotime($schoolDate['end_datetime'])),
    ];
}

echo json_encode($schoolEvents);
?>