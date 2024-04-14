<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Calendrier des congés</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' rel='stylesheet' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
</head>
<body>
    <header>
        <h1>Calendrier des congés</h1>
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
        $('#calendar').fullCalendar({
            editable: true,
            events: 'load_events.php', // Ce fichier PHP chargera les événements (congés) de la base de données
            dayClick: function(date, jsEvent, view) {
                // Ici, vous pouvez ajouter une fonction pour permettre aux utilisateurs de poser un congé
            }
        });
    });
    </script>
</body>
</html>
