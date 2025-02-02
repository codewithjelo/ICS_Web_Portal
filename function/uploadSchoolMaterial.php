<?php
session_start();
include '../connectDb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    if (isset($_FILES['school_materials']) && $_FILES['school_materials']['error'] == 0) {
        $teacher_id = $_SESSION['get_user_id'];
        $section_id = $_POST['section_name'];

       
        $query = "SELECT teacher_id FROM teacher WHERE teacher_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $teacher_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $final_teacher_id = $row['teacher_id'];

       
        $file_name = $_FILES['school_materials']['name'];
        $file_tmp = $_FILES['school_materials']['tmp_name'];
        $file_size = $_FILES['school_materials']['size'];
        $file_type = $_FILES['school_materials']['type'];

        
        $upload_directory = '../school_materials/';
        $file_destination = $upload_directory . basename($file_name);

       
        if (move_uploaded_file($file_tmp, $file_destination)) {
            
            $query = "INSERT INTO school_materials (teacher_id, section_id, school_materials) 
                          VALUES (?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('iis', $final_teacher_id, $section_id, $file_destination);

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
