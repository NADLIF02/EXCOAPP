<?php
require_once '/var/www/src/db.php';

$title = $_POST['title'];
$start = date('Y-m-d', strtotime($_POST['start']));
$end = date('Y-m-d', strtotime($_POST['end']));

$query = "INSERT INTO conges (username, description, start_date, end_date) VALUES ('User', '$title', '$start', '$end')";
if ($mysqli->query($query) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $query . "<br>" . $mysqli->error;
}
$mysqli->close();
