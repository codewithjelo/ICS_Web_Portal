<?php
session_start();
include("../connectDb.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pageName = [
        4 => 'guidanceDashboard',
        5 => 'principalDashboard',
        6 => 'pdoDashboard',
    ];
    $uploaderId = $_SESSION['uploader_id'];
    $firstName = trim($_POST['addFirstName']);
    $middleName = trim($_POST['addMiddleName']);
    $lastName = trim($_POST['addLastName']);
    $email = trim($_POST['addEmail']);
    $password = $_POST['addPassword'];
    $confirmPassword = $_POST['addConfirmPassword'];
    $roleId = (int) $_POST['addRole'];
    $rank = (int) $_POST['addRank'];

    if (empty($firstName) || empty($middleName) || empty($lastName) || empty($email) || empty($password) || empty($roleId) || empty($rank)) {
        $_SESSION['error_message'] = 'All fields are required';
        header("Location: ../pages/{$pageName[intval(strval($uploaderId)[0])]}");
        exit;
    }

    if ($password !== $confirmPassword) {
        $_SESSION['error_message'] = 'Passwords do not match';
        header("Location: ../pages/{$pageName[intval(strval($uploaderId)[0])]}");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = 'Invalid email format';
        header("Location: ../pages/{$pageName[intval(strval($uploaderId)[0])]}");
        exit;
    }

    if (!in_array($roleId, [3, 4, 5, 6])) {
        $_SESSION['error_message'] = 'Invalid role selected';
        header("Location: ../pages/{$pageName[intval(strval($uploaderId)[0])]}");
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $profilePicPath = null;
    if (isset($_FILES['addProfilePic']) && $_FILES['addProfilePic']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/profile_pictures/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileExtension = strtolower(pathinfo($_FILES['addProfilePic']['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($fileExtension, $allowedExtensions)) {
            $_SESSION['error_message'] = 'Invalid file type. Only JPG, PNG, and GIF allowed';
            header("Location: ../pages/{$pageName[intval(strval($uploaderId)[0])]}");
            exit;
        }

        // Generate unique filename
        $fileName = uniqid('profile_', true) . '.' . $fileExtension;
        $profilePicPath = $uploadDir . $fileName;

        if (!move_uploaded_file($_FILES['addProfilePic']['tmp_name'], $profilePicPath)) {
            $_SESSION['error_message'] = 'Failed to upload profile picture';
            header("Location: ../pages/{$pageName[intval(strval($uploaderId)[0])]}");
            exit;
        }
    }

    try {
        $pdo->beginTransaction();

        $personalInfoTables = [
            3 => 'teacher',
            4 => 'guidance',
            5 => 'principal',
            6 => 'pdo'
        ];

        $personalInfoId = null;
        $tableName = $personalInfoTables[$roleId];

        $sqlPersonal = "INSERT INTO `$tableName` 
                       (first_name, middle_name, last_name, email, role_id, rank_id, profile_picture) 
                       VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmtPersonal = $pdo->prepare($sqlPersonal);
        $stmtPersonal->execute([$firstName, $middleName, $lastName, $email, $roleId, $rank, $profilePicPath]);

        $personalInfoId = $pdo->lastInsertId();

        $prefixMap = [
            3 => 'TCH',
            4 => 'GUI',
            5 => 'PRI',
            6 => 'PDO'
        ];

        $userId = 'ICS-' . $prefixMap[$roleId] . $personalInfoId;

        $sqlAccount = "INSERT INTO account (user_id, user_password, role_id) VALUES (?, ?, ?)";
        $stmtAccount = $pdo->prepare($sqlAccount);
        $stmtAccount->execute([$userId, $hashedPassword, $roleId]);

        $pdo->commit();

        $_SESSION['account_added'] = true;

    } catch (PDOException $e) {
        $pdo->rollBack();

        if ($profilePicPath && file_exists($profilePicPath)) {
            unlink($profilePicPath);
        }

        echo json_encode(['success' => false, 'message' => 'Error creating account: ' . $e->getMessage()]);
    }

}
?>