<?php
session_start();
require '../vendor/autoload.php'; 
include '../connectDb.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload_input_grades'])) {
    $uploadDir = '../uploaded_grades/';
    $fileName = basename($_FILES['upload_input_grades']['name']);
    $uploadPath = $uploadDir . $fileName;
    $sectionId = $_POST['section_input_grades']; 
    $subjectId = $_POST['subject_input_grades']; 
    $teacherId = $_POST['teacher_id_input_grades']; 

  
    if (move_uploaded_file($_FILES['upload_input_grades']['tmp_name'], $uploadPath)) {
  
        $spreadsheet = IOFactory::load($uploadPath);
        $sheet = $spreadsheet->getActiveSheet();
        $data = $sheet->toArray(null, true, true, true);

        // Process Excel data
        foreach ($data as $index => $row) {
            if ($index === 1) continue; 

            $lrn = $row['A']; 
            $firstQuarter = $row['B'];
            $secondQuarter = $row['C'];
            $thirdQuarter = $row['D'];
            $fourthQuarter = $row['E'];

          
            $studentQuery = $conn->prepare("SELECT student_id, academic_year FROM student WHERE lrn = ?");
            $studentQuery->bind_param("s", $lrn);
            $studentQuery->execute();
            $result = $studentQuery->get_result();

            if ($result->num_rows > 0) {
                $student = $result->fetch_assoc();
                $studentId = $student['student_id'];
                $academicYear = $student['academic_year'];

              
                $insertQuery = $conn->prepare("INSERT INTO grade (student_id, subject_id, section_id, teacher_id, academic_year, first_quarter, second_quarter, third_quarter, fourth_quarter)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insertQuery->bind_param(
                    "iiiisiiii",
                    $studentId,
                    $subjectId,
                    $sectionId,
                    $teacherId,
                    $academicYear,
                    $firstQuarter,
                    $secondQuarter,
                    $thirdQuarter,
                    $fourthQuarter
                );

                if ($insertQuery->execute()) {
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
