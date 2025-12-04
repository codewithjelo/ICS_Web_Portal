<?php
session_start();
include '../connectDb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    if (isset($_FILES['school_materials']) && $_FILES['school_materials']['error'] == 0) {
        $teacherId = $_SESSION['get_user_id'];
        $sectionId = $_POST['section_name'];

       
        $query = "SELECT teacher_id FROM teacher WHERE teacher_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $teacherId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $finalTeacherId = $row['teacher_id'];

       
        $fileName = $_FILES['school_materials']['name'];
        $fileTmp = $_FILES['school_materials']['tmp_name'];
        $fileSize = $_FILES['school_materials']['size'];
        $fileType = $_FILES['school_materials']['type'];

        
        $uploadDirectory = '../school_materials/';
        $fileDestination = $uploadDirectory . basename($fileName);

       
        if (move_uploaded_file($fileTmp, $fileDestination)) {
            
            $query = "INSERT INTO school_materials (teacher_id, section_id, school_materials) 
                          VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('iis', $finalTeacherId, $sectionId, $fileDestination);

            if ($stmt->execute()) {
                $_SESSION['swal_message'] = [
                    'type' => 'success',
                    'title' => 'File uploaded successfully!',
                ];
            } else {
                $_SESSION['swal_message'] = [
                    'type' => 'error',
                    'title' => 'Failed to upload file to the database.',
                ];
            }
        } else {
            $_SESSION['swal_message'] = [
                'type' => 'error',
                'title' => 'Failed to move the uploaded file.',
            ];
        }
    } else {
        $_SESSION['swal_message'] = [
            'type' => 'error',
            'title' => 'No file uploaded or there was an error uploading the file.',
        ];
    }}
  
    header("Location: ../pages/teacherDashboard");
    exit(); 
?>
