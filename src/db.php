<?php
$host = 'db';
$username = 'admin';
$password = 'admin123';
$database = 'employee_leaves';

// Correctly use the defined variables to create a new mysqli instance
$mysqli = new mysqli($host, $username, $password, $database);

// Check for connection error
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Set character set to utf8 to avoid encoding issues
$mysqli->set_charset("utf8");
?>
