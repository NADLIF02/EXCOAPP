<?php
session_start();
require_once '/var/www/src/db.php';  // Chemin absolu
// db.php - Gérer la connexion à la base de données
$host = 'db';  // Utiliser 'db' qui est le nom du service Docker pour MySQL
$username = 'username'; // Remplacer par votre nom d'utilisateur réel
$password = 'password'; // Remplacer par votre mot de passe réel
$database = 'database_name'; // Remplacer par le nom de votre base de données

$mysqli = new mysqli("db", "admin", "admin123", "employee_leaves");

if ($mysqli->connect_error) {
    die('Erreur de connexion : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>
