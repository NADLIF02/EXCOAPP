<?php
session_start();
require_once '/var/www/src/db.php';  // Assurez-vous que le chemin est correct

// Ajout d'une en-tête pour éviter les problèmes de cache sur les requêtes AJAX
header("Cache-Control: no-cache, must-revalidate");

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
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                editable: true,
                selectable: true,
                selectHelper: true,
                select: function(start, end) {
                    var title = prompt("Entrez le motif de votre congé:");
                    if (title) {
                        $.post('submit_conge.php', {
                            title: title,
                            start: start.format(),
                            end: end.format()
                        }, function(response) {
                            response = JSON.parse(response);
                            alert(response.message);
                            if (response.success) {
                                calendar.fullCalendar('refetchEvents');
                            }
                        });
                    }
                    calendar.fullCalendar('unselect');
                },
                eventLimit: true,
                events: 'load_events.php'
            });
        });
    </script>
</body>
</html>
