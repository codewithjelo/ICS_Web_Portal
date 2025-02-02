<?php
// Database connection
$host = 'localhost: 3308';
$dbname = 'ics_db';
$username = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    
    if ($action === 'add') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $start = $_POST['start'];
        $end = $_POST['end'];

        $query = "INSERT INTO schedule_list (title, description, start_datetime, end_datetime) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$title, $description, $start, $end]);
        echo json_encode(['status' => 'success']);
    }

    
    if ($action === 'edit') {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $start = $_POST['start'];
        $end = $_POST['end'];

        $query = "UPDATE schedule_list SET title = ?, description = ?, start_datetime = ?, end_datetime = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$title, $description, $start, $end, $id]);
        echo json_encode(['status' => 'success']);
    }

    
    if ($action === 'delete') {
        $id = $_POST['id'];

        $query = "DELETE FROM schedule_list WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        echo json_encode(['status' => 'success']);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $query = "SELECT * FROM schedule_list";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($events);
}
?>
