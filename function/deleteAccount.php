<?php
session_start();
include('../connectDb.php');

$pageName = [
    4 => 'guidanceDashboard',
    5 => 'principalDashboard',
    6 => 'pdoDashboard',
];
$uploaderId = $_SESSION['uploader_id'];

// Check if user_id and role_id are provided via GET
if (!isset($_GET['user_id']) || !isset($_GET['role_id'])) {
    header("Location: ../pages/{$pageName[intval(strval($uploaderId)[0])]}?error=Missing parameters");
    exit();
}

$userId = $_GET['user_id'];
$roleId = (int)$_GET['role_id'];

// Define role-specific tables and ID fields
$roleTables = [
    1 => ['table' => 'student', 'id_field' => 'lrn', 'id_value' => $userId], // For student, user_id is lrn
    3 => ['table' => 'teacher', 'id_field' => 'teacher_id', 'id_value' => substr($userId, -4)], // Last 4 digits
    4 => ['table' => 'guidance', 'id_field' => 'guidance_id', 'id_value' => substr($userId, -4)],
    5 => ['table' => 'principal', 'id_field' => 'principal_id', 'id_value' => substr($userId, -4)],
    6 => ['table' => 'pdo', 'id_field' => 'pdo_id', 'id_value' => substr($userId, -4)],
];

// Start transaction for atomicity
mysqli_begin_transaction($conn);

try {
    // Delete from role-specific table if applicable
    if (array_key_exists($roleId, $roleTables)) {
        $table = $roleTables[$roleId]['table'];
        $idField = $roleTables[$roleId]['id_field'];
        $idValue = $roleTables[$roleId]['id_value'];

        $stmt = mysqli_prepare($conn, "DELETE FROM `$table` WHERE `$idField` = ?");
        mysqli_stmt_bind_param($stmt, "s", $idValue);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    // Delete from account table
    $stmt = mysqli_prepare($conn, "DELETE FROM `account` WHERE `user_id` = ?");
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Commit transaction
    mysqli_commit($conn);

    $_SESSION['account_deleted'] = true;

    // Redirect back with success message
    header("Location: ../pages/{$pageName[intval(strval($uploaderId)[0])]}?success=Account deleted successfully");
    exit();

} catch (Exception $e) {
    // Rollback on error
    mysqli_rollback($conn);
    // Redirect back with error
    header("Location: ../pages/{$pageName[intval(strval($uploaderId)[0])]}?error=Failed to delete account: " . $e->getMessage());
    exit();
}

?>