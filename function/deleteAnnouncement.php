<?php
include "../connectDb.php";

if (isset($_POST['announcement_id'])) {
    $announcementId = $_POST['announcement_id'];


    $query = "DELETE FROM announcements WHERE announcement_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $announcementId);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>
