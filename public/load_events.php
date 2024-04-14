<?php
session_start();
require_once '/var/www/src/db.php';

// Cette page renvoie les événements pour le calendrier en format JSON
$stmt = $mysqli->prepare("SELECT id, username, description, start_date, end_date FROM conges");
$stmt->execute();
$result = $stmt->get_result();
$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = [
        'id' => $row['id'],
        'title' => $row['username'] . ': ' . $row['description'],
        'start' => $row['start_date'],
        'end' => $row['end_date']
    ];
}

echo json_encode($events);
$stmt->close();
$mysqli->close();
?>
