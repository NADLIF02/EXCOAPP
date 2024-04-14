<?php
session_start();
require_once '/var/www/src/db.php';  
$month = date('n');  // Mois en chiffres sans les zéros initiaux
$year = date('Y');

// Le code PHP pour récupérer les congés est retiré car nous le chargerons via AJAX
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
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            eventLimit: true, // for all non-agenda views
            views: {
                agenda: {
                    eventLimit: 6 // adjust to 6 only for agendaWeek/agendaDay
                }
            },
            events: function(start, end, timezone, callback) {
                $.ajax({
                    url: '/path_to_load_events.php', // Chemin vers le script PHP qui retourne les données JSON
                    dataType: 'json',
                    data: {
                        // nos données à envoyer
                        start: start.unix(),
                        end: end.unix()
                    },
                    success: function(doc) {
                        var events = [];
                        $(doc).each(function() {
                            events.push({
                                title: $(this).attr('title'),
                                start: $(this).attr('start'), // Assurez-vous que la date de début est correcte
                                end: $(this).attr('end'), // Assurez-vous que la date de fin est correcte
                                backgroundColor: $(this).attr('color'), // Couleur par utilisateur
                                borderColor: $(this).attr('color')
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
