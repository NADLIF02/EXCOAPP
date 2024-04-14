<?php
session_start();
session_start();
require_once '/var/www/src/db.php';
$mysqli = new mysqli("localhost", "username", "password", "database_name"); // Modifiez avec vos vrais données

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$description = $_POST['description'];

$query = "INSERT INTO conges (start_date, end_date, description) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("sss", $start_date, $end_date, $description);
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$mysqli->close();
?>
