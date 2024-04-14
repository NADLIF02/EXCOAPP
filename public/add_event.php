<?php
session_start();
require_once '/var/www/src/db.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username'];
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$start_date = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
$end_date = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);

if (strtotime($start_date) === false || strtotime($end_date) === false) {
    $_SESSION['error'] = 'Invalid date format.';
    header('Location: calendrier.php');
    exit;
}

$stmt = $mysqli->prepare("INSERT INTO conges (username, title, start_date, end_date) VALUES (?, ?, ?, ?)");
if ($stmt->execute([$username, $title, $start_date, $end_date])) {
    $_SESSION['success'] = 'Congé ajouté avec succès.';
} else {
    $_SESSION['error'] = 'Erreur lors de l\'ajout du congé: ' . $stmt->errorInfo()[2];
}

header('Location: calendrier.php');
exit;
?>
