<?php
$host = 'db';
$username = 'admin';
$password = 'admin123';
$database = 'employee_leaves';

$mysqli = new mysqli($db, $admin, $admin123, $employee_leaves);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Définir le charset pour éviter les problèmes d'encodage
$mysqli->set_charset("utf8");
?>
