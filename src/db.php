<?php
// db.php - Gérer la connexion à la base de données
$host = 'db';  // Utiliser 'db' qui est le nom du service Docker pour MySQL
$username = 'username'; // Remplacer par votre nom d'utilisateur réel
$password = 'password'; // Remplacer par votre mot de passe réel
$database = 'database_name'; // Remplacer par le nom de votre base de données

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die('Erreur de connexion : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>
