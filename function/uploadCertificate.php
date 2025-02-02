<?php
session_start();
include '../connectDb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_FILES['student_certificate']) && $_FILES['student_certificate']['error'] == 0) {
        $teacher_id = $_SESSION['get_user_id'];
        $section_id = $_POST['section_cert'];
        $student_id = $_POST['student_cert'];
        $full_name = $_POST['full_name'];

        
        $file_name = $_FILES['student_certificate']['name'];
        $file_tmp = $_FILES['student_certificate']['tmp_name'];
        $file_size = $_FILES['student_certificate']['size'];
        $file_type = $_FILES['student_certificate']['type'];

        
        $upload_directory = '../student_certificate/';
        $file_destination = $upload_directory . basename($file_name);

        
        if (move_uploaded_file($file_tmp, $file_destination)) {
            
            $query = "INSERT INTO e_certificate (e_certificate, full_name, student_id, teacher_id, section_id) 
                          VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ssiii', $file_destination, $full_name, $student_id, $teacher_id, $section_id);

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
