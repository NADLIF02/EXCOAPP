<?php
session_start();
require_once '/var/www/src/db.php';  // Assurez-vous que ce chemin est correct
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
                        var eventData = {
                            title: title,
                            start: start,
                            end: end
                        };
                        // Ajouter l'événement au calendrier
                        $('#calendar').fullCalendar('renderEvent', eventData, true); // stick = true
                        // Envoyer les données au serveur pour enregistrement
                        $.post('/submit_conge.php', {
                            title: title,
                            start: start.format(),
                            end: end.format()
                        }).done(function(response) {
                            alert("Congé ajouté avec succès");
                            $('#calendar').fullCalendar('refetchEvents'); // Recharge les événements pour inclure le nouveau
                        }).fail(function() {
                            alert("Erreur lors de l'ajout du congé");
                        });
                    }
                    $('#calendar').fullCalendar('unselect');
                },
                events: '/load_events.php'  // Assurez-vous que le chemin est correct
            });
        });
    </script>
</body>
</html>
