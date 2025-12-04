<?php
include "../connectDb.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $announcementId = $_POST['announcement_id'];

    $query = "SELECT * FROM announcements WHERE announcement_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $announcementId);
    $stmt->execute();
    $result = $stmt->get_result();
    $announcement = $result->fetch_assoc();

    echo json_encode($announcement);

    $stmt->close();
    $conn->close();
}
?>