<?php
session_start();
include "../connectDb.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $pageName = [
        4 => 'guidanceDashboard',
        5 => 'principalDashboard',
        6 => 'pdoDashboard',
    ];
    $uploaderId = $_SESSION['uploader_id'];
    $announcementTitle = $conn->real_escape_string($_POST['announcement_title']);
    $announcementText = $conn->real_escape_string($_POST['announcement_text']);

    $uploadDir = '../announcement/';
    $uploadedFile = $_FILES['announcement_file'];
    $targetPath = null;


    if (isset($uploadedFile) && $uploadedFile['error'] === UPLOAD_ERR_OK) {
        $fileName = basename($uploadedFile['name']);
        $targetPath = $uploadDir . $fileName;


        if (!move_uploaded_file($uploadedFile['tmp_name'], $targetPath)) {

            $_SESSION['swal_message'] = [
                'type' => 'error',
                'title' => 'Failed to upload the file.',
            ];
            header("Location: ../pages/{$pageName[intval(strval($uploaderId)[0])]}");
            exit;
        }
    }


    $conn->begin_transaction();

    try {

        $insertAnnouncementSql = "INSERT INTO announcements (title, announcement_text, announcement_file, uploader_id) 
                                    VALUES ('$announcementTitle', '$announcementText', " .
            ($targetPath ? "'$targetPath'" : "NULL") . ", $uploaderId)";

        if ($conn->query($insertAnnouncementSql) !== TRUE) {
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

    header("Location: ../pages/{$pageName[intval(strval($uploaderId)[0])]}");
}


$conn->close();
?>