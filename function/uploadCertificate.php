<?php
session_start();
include '../connectDb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_FILES['student_certificate']) && $_FILES['student_certificate']['error'] == 0) {
        $teacherId = $_SESSION['get_user_id'];
        $sectionId = $_POST['section_cert'];
        $studentId = $_POST['student_cert'];
        $fullName = $_POST['full_name'];

        
        $fileName = $_FILES['student_certificate']['name'];
        $fileTmp = $_FILES['student_certificate']['tmp_name'];
        $fileSize = $_FILES['student_certificate']['size'];
        $fileType = $_FILES['student_certificate']['type'];

        
        $uploadDirectory = '../student_certificate/';
        $fileDestination = $uploadDirectory . basename($fileName);

        
        if (move_uploaded_file($fileTmp, $fileDestination)) {
            
            $query = "INSERT INTO e_certificate (e_certificate, full_name, student_id, teacher_id, section_id) 
                          VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssiii', $fileDestination, $fullName, $studentId, $teacherId, $sectionId);

            if ($stmt->execute()) {
                $_SESSION['swal_message'] = [
                    'type' => 'success',
                    'title' => 'Certificate uploaded successfully!',
                ];
            } else {
                $_SESSION['swal_message'] = [
                    'type' => 'error',
                    'title' => 'Failed to upload certificate to the database.',
                ];
            }
        } else {
            $_SESSION['swal_message'] = [
                'type' => 'error',
                'title' => 'Failed to move the certificate.',
            ];
        }
    } else {
        $_SESSION['swal_message'] = [
            'type' => 'error',
            'title' => 'No certificate uploaded or there was an error uploading the certificate.',
        ];
    }
    
    header("Location: ../pages/teacherDashboard");
    exit(); 
}
