<?php
session_start();

// Récupérer les paramètres de connexion de variables d'environnement
$host = getenv('DB_HOST') ?: 'db';  // Utiliser 'db' comme valeur par défaut si non défini
$username = getenv('DB_USER') ?: 'admin';  // Nom d'utilisateur par défaut
$password = getenv('DB_PASS') ?: 'admin123';  // Mot de passe par défaut
$database = getenv('DB_NAME') ?: 'employee_leaves';  // Nom de la base de données par défaut

// Créer une connexion à la base de données
$mysqli = new mysqli($host, $username, $password, $database);

// Vérifier les erreurs de connexion
if ($mysqli->connect_error) {
    die('Erreur de connexion : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
?>
