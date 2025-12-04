<?php
session_start();
include "../connectDb.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentId = $conn->real_escape_string($_POST['get_student_id']);
    $currentStatus = $conn->real_escape_string($_POST['student_status']);
    $gradeSection = $conn->real_escape_string($_POST['grade_section']);
    $academicYear = $conn->real_escape_string($_POST['academic_year']);


    
    $query = "SELECT * FROM student WHERE student_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($currentStatus == 'Passed' || $currentStatus == 'Retained') {

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            
            $lrn = $row['lrn'];
            $firstName = $row['first_name'];
            $middleName = $row['middle_name'];
            $lastName = $row['last_name'];
            $sex = $row['sex'];
            $dateOfBirth = $row['date_of_birth'];
            $pastAcademicYear = $row['academic_year'];
            $parentId = $row['parent_id'];
            $gradeLevelId = $row['grade_level_id'];
            $sectionId = $row['section_id'];
            $updateGradeLevelId = $gradeLevelId + 1;


            
            $turnOverStudentSql = "INSERT INTO student_archives(student_id, lrn, first_name, middle_name, last_name, sex, date_of_birth, current_status, academic_year, parent_id, grade_level_id, section_id)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($turnOverStudentSql);
            $stmt->bind_param('iisssssssiis', $studentId, $lrn, $firstName, $middleName, $lastName, $sex, $dateOfBirth, $currentStatus, $pastAcademicYear, $parentId, $gradeLevelId, $sectionId);

            if ($stmt->execute()) {

                if ($gradeLevelId == 7) {
                    $updateStudent = "UPDATE student 
                        SET academic_year = ?, grade_level_id = ?, section_id = ? 
                        WHERE student_id = ?";
                    $stmt = $conn->prepare($updateStudent);
                    $stmt->bind_param('siis', $academicYear, $gradeLevelId, $gradeSection, $studentId);

                    $stmt->execute();
                } else {
                    $updateStudent = "UPDATE student 
                    SET academic_year = ?, grade_level_id = ?, section_id = ? 
                    WHERE student_id = ?";
                    $stmt = $conn->prepare($updateStudent);
                    $stmt->bind_param('siis', $academicYear, $updateGradeLevelId, $gradeSection, $studentId);

                    $stmt->execute();
                }
                $stmt->close();
            }
        }
        exit;
    } elseif ($currentStatus == 'Dropped') {

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Extract necessary student information
            $lrn = $row['lrn'];
            $firstName = $row['first_name'];
            $middleName = $row['middle_name'];
            $lastName = $row['last_name'];
            $sex = $row['sex'];
            $dateOfBirth = $row['date_of_birth'];
            $pastAcademicYear = $row['academic_year'];
            $parentId = $row['parent_id'];
            $gradeLevelId = $row['grade_level_id'];
            $sectionId = $row['section_id'];

            
            $turnOverStudentSql = "INSERT INTO student_archives(student_id, lrn, first_name, middle_name, last_name, sex, date_of_birth, current_status, academic_year, parent_id, grade_level_id, section_id)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $archive_stmt = $conn->prepare($turnOverStudentSql);
            $archive_stmt->bind_param('iisssssssiis', $studentId, $lrn, $firstName, $middleName, $lastName, $sex, $dateOfBirth, $currentStatus, $pastAcademicYear, $parentId, $gradeLevelId, $sectionId);

            if ($archive_stmt->execute()) {

                        
                        $updateStudent = "UPDATE student 
                        SET current_status = ? 
                        WHERE student_id = ?";
                        $update_student_stmt = $conn->prepare($updateStudent);
                        $update_student_stmt->bind_param('si', $currentStatus, $studentId);
                        if ($update_student_stmt->execute()) {

                            
                            $delete_account = "DELETE FROM account WHERE user_id = ?";
                            $delete_account_stmt = $conn->prepare($delete_account);
                            $delete_account_stmt->bind_param('i', $lrn);
                            $delete_account_stmt->execute();

                            $delete_account_stmt->close();
                        }
                    

                    $parent_archive_stmt->close();
                

                
                $parent_stmt->close();
            }

            
            $archive_stmt->close();
        }
    }
    $conn->close();
}
