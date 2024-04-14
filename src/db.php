<?php
// db.php - Gérer la connexion à la base de données avec PDO

$host = 'db';  // Utiliser 'db' qui est le nom du service Docker pour MySQL
$username = 'admin';  // Nom d'utilisateur pour MySQL
$password = 'admin123';  // Mot de passe pour MySQL
$database = 'employee_leaves';  // Nom de la base de données

try {
    $db = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}
?>
