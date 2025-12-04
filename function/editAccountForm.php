<?php
session_start();
include "../connectDb.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pageName = [
        4 => 'guidanceDashboard',
        5 => 'principalDashboard',
        6 => 'pdoDashboard',
    ];
    $uploaderId = $_SESSION['uploader_id'];
    $userId = mysqli_real_escape_string($conn, $_POST['user_id']);
    $roleId = mysqli_real_escape_string($conn, $_POST['role_id']);
    $firstName = mysqli_real_escape_string($conn, $_POST['editFirstName']);
    $middleName = mysqli_real_escape_string($conn, $_POST['editMiddleName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['editLastName']);
    $email = mysqli_real_escape_string($conn, $_POST['editEmail']);

    // Handle password update
    $passwordUpdated = false;
    if (!empty($_POST['editPassword'])) {
        $hashedPassword = password_hash($_POST['editPassword'], PASSWORD_DEFAULT);
        $passwordQuery = "UPDATE account SET user_password='$hashedPassword' WHERE user_id='$userId'";
        if (mysqli_query($conn, $passwordQuery)) {
            $passwordUpdated = true;
        }
    }

    // Handle profile picture upload
    $profilePicPath = null;
    $shouldUpdateProfilePic = false;

    if (isset($_FILES['editProfile']) && $_FILES['editProfile']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/profile_pictures/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileExtension = strtolower(pathinfo($_FILES['editProfile']['name'], PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($fileExtension, $allowedExtensions)) {
            $_SESSION['error_message'] = 'Invalid file type. Only JPG, PNG, and GIF allowed';
            header("Location: ../pages/{$pageName[intval(strval($uploaderId)[0])]}");
            exit;
        }

        // Delete old profile picture if exists
        if ($roleId == 1) {
            $oldPicQuery = "SELECT profile_picture FROM student WHERE lrn='$userId'";
        } elseif (in_array($roleId, [3, 4, 5, 6])) {
            $table = ($roleId == 3) ? 'teacher' : (($roleId == 4) ? 'guidance' : (($roleId == 5) ? 'principal' : 'pdo'));
            $idField = ($roleId == 3) ? 'teacher_id' : (($roleId == 4) ? 'guidance_id' : (($roleId == 5) ? 'principal_id' : 'pdo_id'));
            $oldPicQuery = "SELECT profile_picture FROM $table WHERE $idField=RIGHT('$userId', 4)";
        }

        if (isset($oldPicQuery)) {
            $oldPicResult = mysqli_query($conn, $oldPicQuery);
            if ($oldPicResult && mysqli_num_rows($oldPicResult) > 0) {
                $oldPicRow = mysqli_fetch_assoc($oldPicResult);
                $oldPicPath = $oldPicRow['profile_picture'];
                if ($oldPicPath && file_exists($oldPicPath) && $oldPicPath !== '../uploads/profile_pictures/avatar.jpg') {
                    unlink($oldPicPath);
                }
            }
        }

        // Generate unique filename
        $fileName = uniqid('profile_', true) . '.' . $fileExtension;
        $profilePicPath = $uploadDir . $fileName;

        if (!move_uploaded_file($_FILES['editProfile']['tmp_name'], $profilePicPath)) {
            $_SESSION['error_message'] = 'Failed to upload profile picture';
            header("Location: ../pages/{$pageName[intval(strval($uploaderId)[0])]}");
            exit;
        }

        $shouldUpdateProfilePic = true;
    }

    $updateSuccess = false;

    if ($roleId == 1) {
        // Build query for student
        if ($shouldUpdateProfilePic) {
            $query = "UPDATE student SET first_name='$firstName', middle_name='$middleName', last_name='$lastName', profile_picture='$profilePicPath' WHERE lrn='$userId'";
        } else {
            $query = "UPDATE student SET first_name='$firstName', middle_name='$middleName', last_name='$lastName' WHERE lrn='$userId'";
        }
        $updateSuccess = mysqli_query($conn, $query);

        if ($updateSuccess) {
            $query = "UPDATE parent SET email='$email' WHERE parent_id=(SELECT parent_id FROM student WHERE lrn='$userId')";
            $updateSuccess = mysqli_query($conn, $query);
        }
    } elseif (in_array($roleId, [3, 4, 5, 6])) {
        $table = ($roleId == 3) ? 'teacher' : (($roleId == 4) ? 'guidance' : (($roleId == 5) ? 'principal' : 'pdo'));
        $idField = ($roleId == 3) ? 'teacher_id' : (($roleId == 4) ? 'guidance_id' : (($roleId == 5) ? 'principal_id' : 'pdo_id'));

        // Build query based on whether profile picture was uploaded
        if ($shouldUpdateProfilePic) {
            $query = "UPDATE $table SET first_name='$firstName', middle_name='$middleName', last_name='$lastName', email='$email', profile_picture='$profilePicPath' WHERE $idField=RIGHT('$userId', 4)";
        } else {
            $query = "UPDATE $table SET first_name='$firstName', middle_name='$middleName', last_name='$lastName', email='$email' WHERE $idField=RIGHT('$userId', 4)";
        }
        $updateSuccess = mysqli_query($conn, $query);
    }

    if ($updateSuccess) {
        $_SESSION['account_updated'] = true;
    } else {
        $_SESSION['error_message'] = 'Failed to update account information';
    }

    header("Location: ../pages/{$pageName[intval(strval($uploaderId)[0])]}");
    exit;
}
?>