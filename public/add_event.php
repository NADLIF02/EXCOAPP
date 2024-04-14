<?php
session_start();
require_once '/var/www/src/db.php'; // Assurez-vous que ce fichier configure PDO correctement

// Vérifiez si l'utilisateur est connecté avant de procéder
if (!isset($_SESSION['username'])) {
    // Redirection si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit;
}

$username = $_SESSION['username']; // Utilisez le nom d'utilisateur de la session
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING); // Nettoyage de l'entrée pour éviter les injections XSS
$start_date = filter_input(INPUT_POST, 'start', FILTER_SANITIZE_STRING);
$end_date = filter_input(INPUT_POST, 'end', FILTER_SANITIZE_STRING);

// Vérifiez que les dates sont valides
if (strtotime($start_date) === false || strtotime($end_date) === false) {
    // Gérer l'erreur de date invalide
    $_SESSION['error'] = 'Invalid date format.';
    header('Location: calendrier.php');
    exit;
}

// Préparation de la requête pour éviter les injections SQL
$query = "INSERT INTO conges (username, title, start_date, end_date) VALUES (?, ?, ?, ?)";
$stmt = $db->prepare($query);

// Gestion des erreurs de la requête
if ($stmt->execute([$username, $title, $start_date, $end_date])) {
    $_SESSION['success'] = 'Congé ajouté avec succès.';
} else {
    $_SESSION['error'] = 'Erreur lors de l\'ajout du congé: ' . $stmt->errorInfo()[2]; // [2] contient le message d'erreur de PDO
}

header('Location: calendrier.php');
exit;
?>
