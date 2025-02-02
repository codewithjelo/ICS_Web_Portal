<?php
include "../connectDb.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $announcement_id = $_POST['announcement_id'];
    
    
    $announcement_title = $conn->real_escape_string($_POST['announcement_title']);
    
    
    $announcement_text = stripslashes($_POST['announcement_text']); // Remove backslashes
    $announcement_text = $conn->real_escape_string($announcement_text); // Escape the text

    
    $query = "UPDATE announcements SET title = ?, announcement_text = ? WHERE announcement_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $announcement_title, $announcement_text, $announcement_id);

    
    if ($stmt->execute()) {
        header("Location: ../pages/guidanceDashboard");
        exit; 
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
}
?>
