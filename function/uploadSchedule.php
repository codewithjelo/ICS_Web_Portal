<?php
require '../vendor/autoload.php'; 
use PhpOffice\PhpSpreadsheet\IOFactory;

session_start(); 

function uploadSchedule($file) {
    // Database connection parameters
    $host     = 'localhost:3308';
    $username = 'root';
    $password = '';
    $dbname   = 'ics_db';

    try {
       
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $section_id = $_POST['section_schedule'];

       
        $archiveStmt = $pdo->prepare("INSERT INTO class_schedule_archive (class_time, subject_name, weekday, section_id) SELECT class_time, subject_name, weekday, section_id FROM class_schedule WHERE section_id = ?");
        $archiveStmt->execute([$section_id]);

        
        $deleteStmt = $pdo->prepare("DELETE FROM class_schedule WHERE section_id = ?");
        $deleteStmt->execute([$section_id]);

        $spreadsheet = IOFactory::load($file['tmp_name']);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true); // Load data as an associative array

       
        $insertStmt = $pdo->prepare("INSERT INTO class_schedule (class_time, subject_name, weekday, section_id) VALUES (?, ?, ?, ?)");

        
        $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

       
        foreach ($rows as $rowIndex => $row) {
            if ($rowIndex == 1) continue; 

            $time = $row['A'];

          
            foreach ($weekdays as $i => $weekday) {
                $subject_name = $row[chr(66 + $i)];

              
                if (!empty($subject_name)) {
                    $insertStmt->execute([$time, $subject_name, $weekday, $section_id]);
                }
            }
        }

      
        $_SESSION['swal_message'] = [
            'type' => 'success',
            'title' => "Schedule uploaded successfully.",
        ];

    } catch (Exception $e) {
        
        $_SESSION['swal_message'] = [
            'type' => 'success',
            'title' => "Schedule uploaded successfully.",
        ];
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload_schedule'])) {
    uploadSchedule($_FILES['upload_schedule']);
    header('Location: ../pages/guidanceDashboard'); 
    exit(); 
}
?>
