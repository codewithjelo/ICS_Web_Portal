<?php
include "../connectDb.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pageName = [
        4 => 'guidanceDashboard',
        5 => 'principalDashboard',
        6 => 'pdoDashboard',
    ];
    
    $announcementId = $_POST['announcement_id'];
    
    
    $announcementTitle = $conn->real_escape_string($_POST['announcement_title']);
    
    
    $announcementText = stripslashes($_POST['announcement_text']); // Remove backslashes
    $announcementText = $conn->real_escape_string($announcementText); // Escape the text

    
    $query = "UPDATE announcements SET title = ?, announcement_text = ? WHERE announcement_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $announcementTitle, $announcementText, $announcementId);

    
    if ($stmt->execute()) {
        header("Location: ../pages/{$pageName[intval(strval($_SESSION['uploader_id'])[0])]}");
        exit; 
    } else {
        echo "Error: " . $stmt->error;
    }

    
    $stmt->close();
    $conn->close();
}
?>
