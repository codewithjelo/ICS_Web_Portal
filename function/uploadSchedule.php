<?php
require '../vendor/autoload.php';
require '../connectDb.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

session_start();

function uploadSchedule($file)
{
    global $pdo; 


    $sectionId = $_POST['section_schedule'];

    try {
        // Archive existing data
        $archiveStmt = $pdo->prepare("INSERT INTO class_schedule_archive (class_time, subject_name, weekday, section_id) SELECT class_time, subject_name, weekday, section_id FROM class_schedule WHERE section_id = ?");
        $archiveStmt->execute([$sectionId]);

        // Delete existing data
        $deleteStmt = $pdo->prepare("DELETE FROM class_schedule WHERE section_id = ?");
        $deleteStmt->execute([$sectionId]);

        // Load and process the spreadsheet (unchanged)
        $spreadsheet = IOFactory::load($file['tmp_name']);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        $insertStmt = $pdo->prepare("INSERT INTO class_schedule (class_time, subject_name, weekday, section_id) VALUES (?, ?, ?, ?)");

        $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

        foreach ($rows as $rowIndex => $row) {
            if ($rowIndex == 1)
                continue;
            $time = $row['A'];
            foreach ($weekdays as $i => $weekday) {
                $subjectName = $row[chr(66 + $i)];
                if (!empty($subjectName)) {
                    $insertStmt->execute([$time, $subjectName, $weekday, $sectionId]);
                }
            }
        }

        $_SESSION['swal_message'] = [
            'type' => 'success',
            'title' => "Schedule uploaded successfully.",
        ];
    } catch (Exception $e) {
        // Handle errors properly (see note below)
        $_SESSION['swal_message'] = [
            'type' => 'error',
            'title' => "Error uploading schedule: " . $e->getMessage(),
        ];
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload_schedule'])) {
    uploadSchedule($_FILES['upload_schedule']);
    header('Location: ../pages/guidanceDashboard');
    exit();
}
?>