<?php
$host = 'db';  // L'adresse du serveur de base de données
$username = 'admin';  // Le nom d'utilisateur pour se connecter
$password = 'admin123';  // Le mot de passe pour se connecter
$database = 'employee_leaves';  // Le nom de la base de données

try {
    $db = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
