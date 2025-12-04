<?php
session_start();
include "../connectDb.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = isset($_POST['get_lrn_student_id']) ? (int)$_POST['get_lrn_student_id'] : null;
    $lrn = isset($_POST['student_lrn']) ? (int)$_POST['student_lrn'] : null;
    $password = isset($_POST['student_password']) ? $conn->real_escape_string($_POST['student_password']) : null;
    $confirmPassword = isset($_POST['confirm_password']) ? $conn->real_escape_string($_POST['confirm_password']) : null;

    if (!$studentId || !$lrn || !$password || !$confirmPassword) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit;
    }

    if (!preg_match('/^\d{12}$/', $lrn)) {
        echo json_encode(["status" => "error", "message" => "Invalid LRN. Must be 12 digits."]);
        exit;
    }

    if ($password !== $confirmPassword) {
        echo json_encode(["status" => "error", "message" => "Passwords do not match."]);
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $conn->begin_transaction();

    try {
        
        $updateStudentAccountSql = "UPDATE student SET lrn = ? WHERE student_id = ?";
        $stmt = $conn->prepare($updateStudentAccountSql);
        $stmt->bind_param("ii", $lrn, $studentId);

        if (!$stmt->execute()) {
            throw new Exception("Error updating LRN: " . $stmt->error);
        }

        
        error_log("Update Query Successful: LRN $lrn for Student ID $studentId");

        
        $insertStudentAccountSql = "INSERT INTO account (user_id, user_password, role_id) VALUES (?, ?, 1)";
        $stmt = $conn->prepare($insertStudentAccountSql);
        $stmt->bind_param("is", $lrn, $hashedPassword);

        if (!$stmt->execute()) {
            throw new Exception("Error inserting account credentials: " . $stmt->error);
        }

        
        error_log("Insert Query Successful: User ID $lrn with Role ID 1");

        $conn->commit();
        echo json_encode(["status" => "success", "message" => "Student account created successfully."]);
    } catch (Exception $e) {
        $conn->rollback();
        error_log("Transaction Failed: " . $e->getMessage());
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    } finally {
        $stmt->close();
        $conn->close();
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
    exit;
}
