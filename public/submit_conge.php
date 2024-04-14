<?php
require_once '/var/www/src/db.php';

$title = $_POST['title'];
$start = date('Y-m-d', strtotime($_POST['start']));
$end = date('Y-m-d', strtotime($_POST['end']));
$username = $_SESSION['username']; // Assurez-vous que l'utilisateur est connecté et récupérez son nom

$query = "INSERT INTO conges (username, description, start_date, end_date) VALUES ('$username', '$title', '$start', '$end')";
$response = [];
if ($mysqli->query($query) === TRUE) {
    $response['success'] = true;
    $response['message'] = "Congé ajouté avec succès";
} else {
    $response['success'] = false;
    $response['message'] = "Erreur lors de l'ajout du congé: " . $mysqli->error;
}
echo json_encode($response);
$mysqli->close();
?>
