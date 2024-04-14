<?php
require_once '/var/www/src/db.php';

// Assurez-vous que l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    echo json_encode(['success' => false, 'message' => "Erreur: utilisateur non connecté."]);
    exit;
}

$username = $_SESSION['username'];
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$start = date('Y-m-d', strtotime($_POST['start']));
$end = date('Y-m-d', strtotime($_POST['end']));

// Préparation de la requête pour éviter les injections SQL
$stmt = $mysqli->prepare("INSERT INTO conges (username, description, start_date, end_date) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $title, $start, $end);

$response = [];
if ($stmt->execute()) {
    $response['success'] = true;
    $response['message'] = "Congé ajouté avec succès";
} else {
    $response['success'] = false;
    $response['message'] = "Erreur lors de l'ajout du congé: " . $mysqli->error;
}
echo json_encode($response);

$stmt->close();
$mysqli->close();
?>
