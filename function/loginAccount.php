<?php
session_start();
include '../connectDb.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs
    $userId = $_POST['user_id'];
    $password = $_POST['user_password'];

  
    $userId = mysqli_real_escape_string($conn, $userId);
    $password = mysqli_real_escape_string($conn, $password);

    
    $query = "SELECT * FROM account WHERE user_id = '$userId'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $row['user_password'])) {
           
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['role_id'] = $row['role_id'];
            $_SESSION['logged_in'] = true;

            
            switch ($row['role_id']) {
                case 1:
                    header("Location: ../pages/parentDashboard");
                    break;
                case 3:
                    header("Location: ../pages/teacherDashboard");
                    break;
                case 4:
                    header("Location: ../pages/guidanceDashboard");
                    break;
                case 5:
                    header("Location: ../pages/principalDashboard");
                    break;
                case 6:
                    header("Location: ../pages/pdoDashboard");
                    break;
                default:
                    
                    header("Location: ../index");
                    break;
            }
            exit();
        } else {
          
            $_SESSION['error_message'] = "Invalid password.";
        }
    } else {
        
        $_SESSION['error_message'] = "User ID not found.";
    }

   
    header("Location: ../index");
    exit();
}
