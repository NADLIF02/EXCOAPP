<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=nom_de_votre_base', 'utilisateur', 'mot_de_passe');

$username = $_SESSION['username']; // Assurez-vous que l'utilisateur est connecté et stockez son nom dans la session
$title = $_POST['title'];
$start_date = $_POST['start'];
$end_date = $_POST['end'];

$query = "INSERT INTO conges (username, title, start_date, end_date) VALUES (?, ?, ?, ?)";
$stmt = $db->prepare($query);
$stmt->execute([$username, $title, $start_date, $end_date]);

header('Location: calendrier.php');
exit;
?>
