<?php
session_start();
include "../connectDb.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $conn->real_escape_string($_POST['get_student_id']);
    $current_status = $conn->real_escape_string($_POST['student_status']);
    $grade_section = $conn->real_escape_string($_POST['grade_section']);
    $academic_year = $conn->real_escape_string($_POST['academic_year']);


    
    $query = "SELECT * FROM student WHERE student_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($current_status == 'Passed' || $current_status == 'Retained') {

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            
            $lrn = $row['lrn'];
            $first_name = $row['first_name'];
            $middle_name = $row['middle_name'];
            $last_name = $row['last_name'];
            $sex = $row['sex'];
            $date_of_birth = $row['date_of_birth'];
            $past_academic_year = $row['academic_year'];
            $parent_id = $row['parent_id'];
            $grade_level_id = $row['grade_level_id'];
            $section_id = $row['section_id'];
            $update_grade_level_id = $grade_level_id + 1;


            
            $turn_over_student = "INSERT INTO student_archives(student_id, lrn, first_name, middle_name, last_name, sex, date_of_birth, current_status, academic_year, parent_id, grade_level_id, section_id)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($turn_over_student);
            $stmt->bind_param('iisssssssiis', $student_id, $lrn, $first_name, $middle_name, $last_name, $sex, $date_of_birth, $current_status, $past_academic_year, $parent_id, $grade_level_id, $section_id);

            if ($stmt->execute()) {

                if ($grade_level_id == 7) {
                    $update_student = "UPDATE student 
                        SET academic_year = ?, grade_level_id = ?, section_id = ? 
                        WHERE student_id = ?";
                    $stmt = $conn->prepare($update_student);
                    $stmt->bind_param('siis', $academic_year, $grade_level_id, $grade_section, $student_id);

                    $stmt->execute();
                } else {
                    $update_student = "UPDATE student 
                    SET academic_year = ?, grade_level_id = ?, section_id = ? 
                    WHERE student_id = ?";
                    $stmt = $conn->prepare($update_student);
                    $stmt->bind_param('siis', $academic_year, $update_grade_level_id, $grade_section, $student_id);

                    $stmt->execute();
                }
                $stmt->close();
            }
        }
        exit;
    } elseif ($current_status == 'Dropped') {

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Extract necessary student information
            $lrn = $row['lrn'];
            $first_name = $row['first_name'];
            $middle_name = $row['middle_name'];
            $last_name = $row['last_name'];
            $sex = $row['sex'];
            $date_of_birth = $row['date_of_birth'];
            $past_academic_year = $row['academic_year'];
            $parent_id = $row['parent_id'];
            $grade_level_id = $row['grade_level_id'];
            $section_id = $row['section_id'];

            
            $turn_over_student = "INSERT INTO student_archives(student_id, lrn, first_name, middle_name, last_name, sex, date_of_birth, current_status, academic_year, parent_id, grade_level_id, section_id)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $archive_stmt = $conn->prepare($turn_over_student);
            $archive_stmt->bind_param('iisssssssiis', $student_id, $lrn, $first_name, $middle_name, $last_name, $sex, $date_of_birth, $current_status, $past_academic_year, $parent_id, $grade_level_id, $section_id);

            if ($archive_stmt->execute()) {

                        
                        $update_student = "UPDATE student 
                        SET current_status = ? 
                        WHERE student_id = ?";
                        $update_student_stmt = $conn->prepare($update_student);
                        $update_student_stmt->bind_param('si', $current_status, $student_id);
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
