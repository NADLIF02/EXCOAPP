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
            var eventData;
            if (title) {
                eventData = {
                    title: title,
                    start: start,
                    end: end
                };
                $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                // Ajouter ici le code pour envoyer les données au serveur
                $.post('/submit_conge.php', {
                    title: title,
                    start: start.format(),
                    end: end.format()
                }, function(response){
                    alert("Congé ajouté avec succès");
                });
            }
            $('#calendar').fullCalendar('unselect');
        },
        eventLimit: true, // allow "more" link when too many events
        events: '/path_to_load_events.php',
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
