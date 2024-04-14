<?php
header('Content-Type: application/json');
require_once '/var/www/src/db.php';

$start = date('Y-m-d', $_GET['start']);
$end = date('Y-m-d', $_GET['end']);

$query = "SELECT username, description, start_date AS start, end_date AS end FROM conges WHERE start_date BETWEEN '$start' AND '$end' OR end_date BETWEEN '$start' AND '$end'";
$result = $mysqli->query($query);

$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = [
        'title' => $row['username'] . ': ' . $row['description'],
        'start' => $row['start'],
        'end' => $row['end'],
        'color' => '#' . substr(md5($row['username']), 0, 6)  // Génère une couleur hexadécimale basée sur le nom d'utilisateur
    ];
}
echo json_encode($events);
$mysqli->close();
?>
