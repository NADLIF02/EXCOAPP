<?php
header('Content-Type: application/json');
require_once '/var/www/src/db.php';

$start = $_GET['start'];
$end = $_GET['end'];

$query = "SELECT username, description, start_date AS start, end_date AS end FROM conges WHERE start_date BETWEEN ? AND ? OR end_date BETWEEN ? AND ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param("ssss", $start, $end, $start, $end);
$stmt->execute();
$result = $stmt->get_result();

$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = [
        'title' => $row['username'] . ': ' . $row['description'],
        'start' => $row['start'],
        'end' => $row['end'],
        'color' => '#' . substr(md5($row['username']), 0, 6)  // Couleur unique par utilisateur
    ];
}
echo json_encode($events);
$mysqli->close();
?>
