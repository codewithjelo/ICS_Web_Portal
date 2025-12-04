<?php

// Start the session
session_start();

// Database connection
include "../connectDb.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $year = (int)date("Y");
    $academicYear = date("Y") . "-" . ($year + 1);

    // Sanitize and format input
    $firstName = ucfirst(strtolower($conn->real_escape_string($_POST['first_name'])));
    $middleName = ucfirst(strtolower($conn->real_escape_string($_POST['middle_name'])));
    $lastName = ucfirst(strtolower($conn->real_escape_string($_POST['last_name'])));
    $sex = ucfirst(strtolower($conn->real_escape_string($_POST['sex'])));
    $dateOfBirth = $conn->real_escape_string($_POST['date_of_birth']);
    $address = ucfirst(strtolower($conn->real_escape_string($_POST['address_enrollment'])));
    $parentFirstName = ucfirst(strtolower($conn->real_escape_string($_POST['parent_first_name'])));
    $parentLastName = ucfirst(strtolower($conn->real_escape_string($_POST['parent_last_name'])));
    $parentEmail = strtolower($conn->real_escape_string($_POST['parent_email']));
    $parentContact = $conn->real_escape_string($_POST['parent_contact']);
    $civilStatus = ucfirst(strtolower($conn->real_escape_string($_POST['civil_status'])));
    $gradeLevel = $conn->real_escape_string($_POST['grade_level']);
    $section = $conn->real_escape_string($_POST['section']);

    // Handle file uploads
    $uploadDir = '../uploads/';

    
    $studentPicture = uniqid('student_') . '.' . pathinfo($_FILES['student_picture']['name'], PATHINFO_EXTENSION);
    $psaBirthCertificate = uniqid('psa_') . '.' . pathinfo($_FILES['psa_birth_certificate']['name'], PATHINFO_EXTENSION);
    $progressReportCard = uniqid('report_') . '.' . pathinfo($_FILES['progress_report_card']['name'], PATHINFO_EXTENSION);
    $medicalAssessmentName = uniqid('medical_') . '.' . pathinfo($_FILES['medical_assessment']['name'], PATHINFO_EXTENSION);

    // Full file paths
    $studentPicture = $uploadDir . $studentPicture;
    $psaBirthCertificate = $uploadDir . $psaBirthCertificate;
    $progressReportCard = $uploadDir . $progressReportCard;
    $medicalAssessment = $uploadDir . $medicalAssessmentName;

    if (
        move_uploaded_file($_FILES['student_picture']['tmp_name'], $studentPicture) &&
        move_uploaded_file($_FILES['psa_birth_certificate']['tmp_name'], $psaBirthCertificate) &&
        move_uploaded_file($_FILES['progress_report_card']['tmp_name'], $progressReportCard) &&
        move_uploaded_file($_FILES['medical_assessment']['tmp_name'], $medicalAssessment)
    ) {
        
        $parentSql = "INSERT INTO parent (first_name, last_name, email, phone_number, address, civil_status, role_id) 
                       VALUES ('$parentFirstName', '$parentLastName', '$parentEmail', $parentContact, '$address', '$civilStatus', 2)";
        if ($conn->query($parentSql) === TRUE) {
            $parentId = $conn->insert_id; 

            
            $studentSql = "INSERT INTO student (first_name, middle_name, last_name, sex, date_of_birth, current_status, academic_year, parent_id, grade_level_id, section_id, role_id) 
                            VALUES ('$firstName', '$middleName', '$lastName', '$sex', '$dateOfBirth', 'Enrolled', '$academicYear', $parentId, $gradeLevel, $section, 1)";
            if ($conn->query($studentSql) === TRUE) {
                $studentId = $conn->insert_id; 

                
                $studentFileSql = "INSERT INTO student_file (student_picture, psa_birth_certificate, progress_report_card, medical_assessment, student_id) 
                                     VALUES ('$studentPicture', '$psaBirthCertificate', '$progressReportCard', '$medicalAssessment', $studentId)";
                if ($conn->query($studentFileSql) === TRUE) {
                    $_SESSION['swal_message'] = [
                        'type' => 'success',
                        'title' => 'Student enrollment successful!',
                    ];
                } else {
                    $_SESSION['swal_message'] = [
                        'type' => 'error',
                        'title' => 'Error saving student files: ' . $conn->error,
                    ];
                }
            } else {
                $_SESSION['swal_message'] = [
                    'type' => 'error',
                    'title' => 'Error saving student details: ' . $conn->error,
                ];
            }
        } else {
            $_SESSION['swal_message'] = [
                'type' => 'error',
                'title' => 'Error saving parent details: ' . $conn->error,
            ];
        }
    } else {
        $_SESSION['swal_message'] = [
            'type' => 'error',
            'title' => 'File upload failed.',
        ];
    }
} else {
    $_SESSION['swal_message'] = [
        'type' => 'error',
        'title' => 'Invalid request method.',
    ];
}

header("Location: ../pages/guidanceDashboard");


$conn->close();
?>
