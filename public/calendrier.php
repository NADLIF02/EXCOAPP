<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calendrier des Congés</title>
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
                    right: 'month,agendaWeek,agendaDay,listMonth'
                },
                defaultView: 'month',
                navLinks: true,
                editable: true,
                eventLimit: true,
                events: 'load_events.php',
                eventRender: function(event, element) {
                    element.find('.fc-title').append('<br/><strong>' + event.title + '</strong>');
                },
                selectable: true,
                selectHelper: true,
                select: function(start, end) {
                    var title = prompt('Entrez le motif de votre congé:');
                    if (title) {
                        var eventData = { title: title, start: start, end: end };
                        $('#calendar').fullCalendar('renderEvent', eventData, true);
                        $.post('submit_conge.php', { title: title, start: start.format(), end: end.format() }, function(response) {
                            alert('Réponse du serveur: ' + response);
                        }).fail(function() {
                            alert('Erreur lors de la sauvegarde du congé.');
                        });
                    }
                    $('#calendar').fullCalendar('unselect');
                }
            });
        });
    </script>
</body>
</html>
