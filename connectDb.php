<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbName = 'ics_db';

// MySQLi connection
$conn = new mysqli($host, $username, $password, $dbName);
if (!$conn) {
    die("Cannot connect to the database." . $conn->error);
}

// PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("PDO connection failed: " . $e->getMessage());
}
?>