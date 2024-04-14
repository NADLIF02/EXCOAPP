<?php
session_start();
require_once '/var/www/src/db.php';  // Assurez-vous que le chemin d'accès est correct

// Gestion de l'ajout de congés
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $start = date('Y-m-d', strtotime($_POST['start']));
    $end = date('Y-m-d', strtotime($_POST['end']));
    $username = $_SESSION['username'] ?? 'DefaultUser';  // Utilisez une valeur par défaut ou assurez-vous que la session est toujours active

    $query = "INSERT INTO conges (username, description, start_date, end_date) VALUES ('$username', '$title', '$start', '$end')";
    if ($mysqli->query($query) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Congé ajouté avec succès']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout du congé: ' . $mysqli->error]);
    }
    $mysqli->close();
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calendrier Annuel des Congés</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
</head>
<body>
    <div id='calendar'></div>
    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                selectable: true,
                selectHelper: true,
                select: function(start, end) {
                    var title = prompt("Entrez le motif de votre congé:");
                    if (title) {
                        $.post('calendrier.php', {
                            title: title,
                            start: start.format(),
                            end: end.format()
                        }).done(function(response) {
                            response = JSON.parse(response);
                            alert(response.message);
                            if (response.success) {
                                calendar.fullCalendar('refetchEvents');  // Rafraîchir les événements
                            }
                        });
                    }
                    calendar.fullCalendar('unselect');
                },
                events: function(start, end, timezone, callback) {
                    $.ajax({
                        url: 'load_events.php',  // Assurez-vous que ce fichier gère la requête GET
                        dataType: 'json',
                        data: {
                            start: start.format(),
                            end: end.format()
                        },
                        success: function(response) {
                            var events = [];
                            $(response).each(function() {
                                events.push({
                                    title: this.title,
                                    start: this.start,
                                    end: this.end,
                                    color: this.color
                                });
                            });
                            callback(events);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
