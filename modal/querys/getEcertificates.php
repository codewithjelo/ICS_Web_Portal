<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

session_start();
include "../../connectDb.php";  // Ensure the path to your DB connection is correct

$response = [
    'success' => false,
    'message' => '',
    'data' => []
];

// Check if the database connection is successful
if (!$conn) {
    $response['message'] = 'Database connection failed';
    echo json_encode($response);
    exit;
}

// Retrieve the user_id from the session
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Validate user_id
if ($userId) {



        $query = "SELECT student_id FROM student WHERE lrn = '$userId'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $studentRow = mysqli_fetch_assoc($result);
            $studentId = $studentRow['student_id'];

            // Step 3: Fetch e-certificates for the student (Direct SQL Query)
            $query = "SELECT e_cert_id, subject_id, e_cert FROM e_cert WHERE student_id = $studentId";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $certificates = [];

                while ($row = mysqli_fetch_assoc($result)) {
                    $certificates[] = [
                        'e_cert_id' => $row['e_cert_id'],
                        'subject_id' => $row['subject_id'],
                        'file_name' => $row['e_cert']
                    ];
                }

                $response['success'] = true;
                $response['data'] = $certificates;
            } else {
                $response['success'] = false;
                $response['message'] = 'No e-certificates found for this student.';
            }
        } else {
            $response['success'] = false;
            $response['message'] = 'No student found for the given LRN.';
        }
} else {
    $response['success'] = false;
    $response['message'] = 'User not logged in or session expired.';
}

// Output the JSON response
echo json_encode($response);

// Close database connection
mysqli_close($conn);
?>
