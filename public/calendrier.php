<?php
session_start();
require_once '/var/www/src/db.php';  
$month = date('n'); // Mois en chiffres sans les zéros initiaux
$year = date('Y');

// Début et fin du mois
$startDate = "$year-$month-01";
$endDate = date("Y-m-t", strtotime($startDate));

// Récupérer les congés du mois
$query = "SELECT * FROM conges WHERE (start_date BETWEEN '$startDate' AND '$endDate') OR (end_date BETWEEN '$startDate' AND '$endDate')";
$result = $mysqli->query($query);
$conges = [];
while ($row = $result->fetch_assoc()) {
    $conges[] = $row;
}
$mysqli->close();

$daysInMonth = date('t');
$startDayOfWeek = date('N', strtotime($startDate));
$query = "SELECT * FROM conges WHERE (start_date BETWEEN '$startDate' AND '$endDate') OR (end_date BETWEEN '$startDate' AND '$endDate')";
$result = $mysqli->query($query);

if (!$result) {
    die('Erreur de requête : ' . $mysqli->error);
}

$conges = [];
while ($row = $result->fetch_assoc()) {
    $conges[] = $row;
}
$mysqli->close();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calendrier Annuel des Congés</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="calendar-container">
        <div class="calendar-header">
            <h1><?php echo date('F Y'); ?></h1>
        </div>
        <div class="calendar">
            <?php
            $dayNames = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
            foreach ($dayNames as $dayName) {
                echo "<span class='day-name'>$dayName</span>";
            }

            for ($i = 1; $i < $startDayOfWeek; $i++) {
                echo "<div class='day day--disabled'></div>";
            }
            
            $currentDate = $startDate;
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $isConge = false;
                foreach ($conges as $conge) {
                    if ($conge['start_date'] <= $currentDate && $conge['end_date'] >= $currentDate) {
                        echo "<div class='day' style='background-color: #ffcccc;'>$i<div class='task'>{$conge['description']}</div></div>";
                        $isConge = true;
                        break;
                    }
                }
                if (!$isConge) {
                    echo "<div class='day'>$i</div>";
                }
                $currentDate = date('Y-m-d', strtotime("$currentDate +1 day"));
            }
            ?>
        </div>
    </div>
    <form id="congeForm">
        <input type="date" name="start_date" required>
        <input type="date" name="end_date" required>
        <input type="text" name="description" placeholder="Description">
        <button type="submit">Poser congé</button>
    </form>
    <script src="script.js"></script>
</body>
</html>
