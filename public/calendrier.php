<?php
$month = date('F');
$year = date('Y');
$daysInMonth = date('t');
$startDayOfWeek = date('N', strtotime("$year-$month-01"));
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
            <h1><?php echo $month; ?> <button>▾</button></h1>
            <p><?php echo $year; ?></p>
        </div>
        <div class="calendar">
            <?php
            $dayNames = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
            foreach ($dayNames as $dayName) {
                echo "<span class='day-name'>$dayName</span>";
            }

            $currentDay = 1;
            $cells = $startDayOfWeek + $daysInMonth - 1;
            for ($i = 1; $i <= $cells; $i++) {
                if ($i >= $startDayOfWeek) {
                    echo "<div class='day'>$currentDay</div>";
                    $currentDay++;
                } else {
                    echo "<div class='day day--disabled'></div>";
                }
            }
            ?>
        </div>
        <section class="task task--warning">
            <div class="task__detail">
                <h2>Product Checkup 1</h2>
                <p>15-17th November</p>
            </div>
        </section>
        <section class="task task--danger">Design Sprint</section>
        <section class="task task--primary">Product Checkup 1</section>
        <section class="task task--info">Product Checkup 2</section>
    </div>
</body>
    <form id="congeForm" action="submit_conge.php" method="post">
    <input type="date" name="start_date" required>
    <input type="date" name="end_date" required>
    <input type="text" name="description" placeholder="Description">
    <button type="submit">Poser congé</button>
</form>
// Continuation après récupération des congés
$calendar = "";
$currentDate = "$year-$month-01";
for ($i = 1; $i < $startDayOfWeek; $i++) {
    $calendar .= "<div class='day day--disabled'></div>";
}
for ($i = 1; $i <= $daysInMonth; $i++, $currentDate = date('Y-m-d', strtotime("$currentDate +1 day"))) {
    $dayContent = "<div class='day' data-date='$currentDate'>$i";
    foreach ($conges as $conge) {
        if ($conge['start_date'] <= $currentDate && $conge['end_date'] >= $currentDate) {
            $dayContent .= "<div class='task' style='background-color: #ffcccc;'>{$conge['description']}</div>";
        }
    }
    $dayContent .= "</div>";
    $calendar .= $dayContent;
}

</html>
