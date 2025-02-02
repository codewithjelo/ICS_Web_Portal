<?php
session_start();
include "../connectDb.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $full_name = $conn->real_escape_string($_SESSION['full_name']);
    $rank_name = $conn->real_escape_string($_SESSION['rank_name']);
   
    $announcement_title = $conn->real_escape_string($_POST['announcement_title']);
    $announcement_text = $conn->real_escape_string($_POST['announcement_text']);

    $upload_dir = '../announcement/'; 
    $uploaded_file = $_FILES['announcement_file']; 
    $target_path = null;

    
    if (isset($uploaded_file) && $uploaded_file['error'] === UPLOAD_ERR_OK) {
        $file_name = basename($uploaded_file['name']);
        $target_path = $upload_dir . $file_name;

        
        if (!move_uploaded_file($uploaded_file['tmp_name'], $target_path)) {
            
            $_SESSION['swal_message'] = [
                'type' => 'error',
                'title' => 'Failed to upload the file.',
            ];
            header("Location: ../pages/guidanceDashboard");
            exit;
        }
    }

    
    $conn->begin_transaction();

    try {
        
        $insert_announcement_sql = "INSERT INTO announcements (title, announcement_text, announcement_file, full_name, rank_name) 
                                    VALUES ('$announcement_title', '$announcement_text', " . 
                                    ($target_path ? "'$target_path'" : "NULL") . ", '$full_name', '$rank_name')";

        if ($conn->query($insert_announcement_sql) !== TRUE) {
            throw new Exception("Error inserting into announcements: " . $conn->error);
        }

        $conn->commit();
        $_SESSION['swal_message'] = [
            'type' => 'success',
            'title' => 'Announcement uploaded!',
        ];
    } catch (Exception $e) {
        
        $conn->rollback();

        $_SESSION['swal_message'] = [
            'type' => 'error',
            'title' => $e->getMessage(),
        ];
    }

    header("Location: ../pages/guidanceDashboard");
}


$conn->close();
?>
