<?php
session_start();
require '../vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\IOFactory;


$db_host = 'localhost'; 
$db_name = 'ics_db';
$db_user = 'root';
$db_pass = ''; 

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload_input_grades'])) {
    $upload_dir = '../uploaded_grades/';
    $file_name = basename($_FILES['upload_input_grades']['name']);
    $upload_path = $upload_dir . $file_name;
    $section_id = $_POST['section_input_grades']; 
    $subject_id = $_POST['subject_input_grades']; 
    $teacher_id = $_POST['teacher_id_input_grades']; 

  
    if (move_uploaded_file($_FILES['upload_input_grades']['tmp_name'], $upload_path)) {
  
        $spreadsheet = IOFactory::load($upload_path);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray(null, true, true, true);

        // Process Excel data
        foreach ($data as $index => $row) {
            if ($index === 1) continue; 

            $lrn = $row['A']; 
            $first_quarter = $row['B'];
            $second_quarter = $row['C'];
            $third_quarter = $row['D'];
            $fourth_quarter = $row['E'];

          
            $student_query = $conn->prepare("SELECT student_id, academic_year FROM student WHERE lrn = ?");
            $student_query->bind_param("s", $lrn);
            $student_query->execute();
            $result = $student_query->get_result();

            if ($result->num_rows > 0) {
                $student = $result->fetch_assoc();
                $student_id = $student['student_id'];
                $academic_year = $student['academic_year'];

              
                $insert_query = $conn->prepare("INSERT INTO grade (student_id, subject_id, section_id, teacher_id, academic_year, first_quarter, second_quarter, third_quarter, fourth_quarter)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insert_query->bind_param(
                    "iiiisiiii",
                    $student_id,
                    $subject_id,
                    $section_id,
                    $teacher_id,
                    $academic_year,
                    $first_quarter,
                    $second_quarter,
                    $third_quarter,
                    $fourth_quarter
                );

                if ($insert_query->execute()) {
                    $_SESSION['swal_message'] = [
                        'type' => 'success',
                        'title' => "Grades uploaded successfully!",
                    ];
                } else {
                    $_SESSION['swal_message'] = [
                        'type' => 'error',
                        'title' => "Failed to upload grades for LRN: $lrn.",
                    ];
                }
            } else {
                $_SESSION['swal_message'] = [
                    'type' => 'error',
                    'title' => "No student found for LRN: $lrn.",
                ];
            }
        }
    } else {
        $_SESSION['swal_message'] = [
            'type' => 'error',
            'title' => 'Failed to upload file.',
        ];
    }
} else {
    $_SESSION['swal_message'] = [
        'type' => 'error',
        'title' => 'No file uploaded.',
    ];
}

$conn->close();


header("Location: ../pages/teacherDashboard");
exit();
