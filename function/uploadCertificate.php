<?php
session_start();
include '../connectDb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the file was uploaded without errors
    if (isset($_FILES['student_certificate']) && $_FILES['student_certificate']['error'] == 0) {
        $teacher_id = $_SESSION['get_user_id'];
        $section_id = $_POST['section_cert'];
        $student_id = $_POST['student_cert'];
        $full_name = $_POST['full_name'];

        // Define the file variables
        $file_name = $_FILES['student_certificate']['name'];
        $file_tmp = $_FILES['student_certificate']['tmp_name'];
        $file_size = $_FILES['student_certificate']['size'];
        $file_type = $_FILES['student_certificate']['type'];

        // Specify the directory where the file will be saved
        $upload_directory = '../student_certificate/';
        $file_destination = $upload_directory . basename($file_name);

        // Move the file to the specified directory
        if (move_uploaded_file($file_tmp, $file_destination)) {
            // Insert file details into the database
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
    // Redirect to teacher dashboard
    header("Location: ../pages/teacherDashboard");
    exit(); // Ensure the script stops after redirect
}
