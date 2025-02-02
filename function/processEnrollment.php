<?php

// Start the session
session_start();

// Database connection
include "../connectDb.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $year = (int)date("Y");
    $academic_year = date("Y") . "-" . ($year + 1);

    // Sanitize and format input
    $first_name = ucfirst(strtolower($conn->real_escape_string($_POST['first_name'])));
    $middle_name = ucfirst(strtolower($conn->real_escape_string($_POST['middle_name'])));
    $last_name = ucfirst(strtolower($conn->real_escape_string($_POST['last_name'])));
    $sex = ucfirst(strtolower($conn->real_escape_string($_POST['sex'])));
    $date_of_birth = $conn->real_escape_string($_POST['date_of_birth']);
    $address = ucfirst(strtolower($conn->real_escape_string($_POST['address_enrollment'])));
    $parent_first_name = ucfirst(strtolower($conn->real_escape_string($_POST['parent_first_name'])));
    $parent_last_name = ucfirst(strtolower($conn->real_escape_string($_POST['parent_last_name'])));
    $parent_email = strtolower($conn->real_escape_string($_POST['parent_email']));
    $parent_contact = $conn->real_escape_string($_POST['parent_contact']);
    $civil_status = ucfirst(strtolower($conn->real_escape_string($_POST['civil_status'])));
    $grade_level = $conn->real_escape_string($_POST['grade_level']);
    $section = $conn->real_escape_string($_POST['section']);

    // Handle file uploads
    $upload_dir = '../uploads/'; // Ensure this directory exists and is writable

    // Generate unique names for files
    $student_picture_name = uniqid('student_') . '.' . pathinfo($_FILES['student_picture']['name'], PATHINFO_EXTENSION);
    $psa_birth_certificate_name = uniqid('psa_') . '.' . pathinfo($_FILES['psa_birth_certificate']['name'], PATHINFO_EXTENSION);
    $progress_report_card_name = uniqid('report_') . '.' . pathinfo($_FILES['progress_report_card']['name'], PATHINFO_EXTENSION);
    $medical_assessment_name = uniqid('medical_') . '.' . pathinfo($_FILES['medical_assessment']['name'], PATHINFO_EXTENSION);

    // Full file paths
    $student_picture = $upload_dir . $student_picture_name;
    $psa_birth_certificate = $upload_dir . $psa_birth_certificate_name;
    $progress_report_card = $upload_dir . $progress_report_card_name;
    $medical_assessment = $upload_dir . $medical_assessment_name;

    if (
        move_uploaded_file($_FILES['student_picture']['tmp_name'], $student_picture) &&
        move_uploaded_file($_FILES['psa_birth_certificate']['tmp_name'], $psa_birth_certificate) &&
        move_uploaded_file($_FILES['progress_report_card']['tmp_name'], $progress_report_card) &&
        move_uploaded_file($_FILES['medical_assessment']['tmp_name'], $medical_assessment)
    ) {
        
        $parent_sql = "INSERT INTO parent (first_name, last_name, email, phone_number, address, civil_status, role_id) 
                       VALUES ('$parent_first_name', '$parent_last_name', '$parent_email', $parent_contact, '$address', '$civil_status', 2)";
        if ($conn->query($parent_sql) === TRUE) {
            $parent_id = $conn->insert_id; 

            
            $student_sql = "INSERT INTO student (first_name, middle_name, last_name, sex, date_of_birth, current_status, academic_year, parent_id, grade_level_id, section_id, role_id) 
                            VALUES ('$first_name', '$middle_name', '$last_name', '$sex', '$date_of_birth', 'Enrolled', '$academic_year', $parent_id, $grade_level, $section, 1)";
            if ($conn->query($student_sql) === TRUE) {
                $student_id = $conn->insert_id; 

                
                $student_file_sql = "INSERT INTO student_file (student_picture, psa_birth_certificate, progress_report_card, medical_assessment, student_id) 
                                     VALUES ('$student_picture', '$psa_birth_certificate', '$progress_report_card', '$medical_assessment', $student_id)";
                if ($conn->query($student_file_sql) === TRUE) {
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
