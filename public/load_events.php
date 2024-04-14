<?php
session_start();
require_once '/var/www/src/db.php';
// Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=nom_de_votre_base', 'utilisateur', 'mot_de_passe');
$query = "SELECT id, username, title, start_date AS start, end_date AS end FROM conges";
$stmt = $db->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($results);
?>
