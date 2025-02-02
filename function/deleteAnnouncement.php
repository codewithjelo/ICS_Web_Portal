<?php
include "../connectDb.php";

if (isset($_POST['announcement_id'])) {
    $announcement_id = $_POST['announcement_id'];


    $query = "DELETE FROM announcements WHERE announcement_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $announcement_id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>
