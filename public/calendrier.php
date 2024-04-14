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
    <header>
        <h1>Calendrier Annuel des Congés</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="calendrier.php">Calendrier</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <div id='calendar'></div>
    </section>

    <script>
    $(document).ready(function() {
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay' // Pas d'option annuelle directe, considérez 'timelineYear' si vous avez premium plugins
            },
            defaultView: 'month', // FullCalendar n'a pas de vue annuelle standard, 'timelineYear' nécessite un plugin premium
            events: 'load_events.php', // Ce fichier PHP chargera les événements (congés) de la base de données
            dayClick: function(date, jsEvent, view) {
                var title = prompt('Intitulé du congé:');
                if (title) {
                    var startDate = prompt('Début du congé (format JJ-MM-AAAA):', date.format('DD-MM-YYYY'));
                    var endDate = prompt('Fin du congé (format JJ-MM-AAAA):', date.format('DD-MM-YYYY'));
                    if (startDate && endDate) {
                        $.post('add_event.php', {
                            title: title,
                            start: moment(startDate, 'DD-MM-YYYY').format('YYYY-MM-DD'),
                            end: moment(endDate, 'DD-MM-YYYY').add(1, 'days').format('YYYY-MM-DD'),
                            username: 'VotreNomUtilisateur' // Remplacer par la session de l'utilisateur ou autre logique
                        }, function() {
                            calendar.fullCalendar('refetchEvents');
                        });
                    }
                }
            },
            eventClick: function(event, jsEvent, view) {
                var confirmDelete = confirm("Voulez-vous supprimer ce congé ?");
                if (confirmDelete) {
                    $.post('delete_event.php', { id: event.id }, function() {
                        calendar.fullCalendar('removeEvents', event.id);
                    });
                }
            },
            eventRender: function(event, element) {
                element.find('.fc-title').append('<br/>' + event.username); // Affiche le nom d'utilisateur sous le titre
                element.css('background-color', event.color); // Utilise une couleur spécifique pour chaque utilisateur
            }
        });
    });
    </script>
</body>
</html>
