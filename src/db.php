<?php
session_start();
require_once '/var/www/src/db.php';  // Ce chemin semble incorrect s'il est dans db.php lui-même

// db.php - Gérer la connexion à la base de données
$host = 'db';  // Utiliser 'db' qui est le nom du service Docker pour MySQL
$username = 'admin';  // Nom d'utilisateur pour MySQL
$password = 'admin123';  // Mot de passe pour MySQL
$database = 'employee_leaves';  // Nom de la base de données

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die('Erreur de connexion : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>
