<?php
$host = 'db';
$username = 'admin';
$password = 'admin123';
$database = 'employee_leaves';

$db = new PDO("mysql:host=$host;dbname=$database", $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
?>
