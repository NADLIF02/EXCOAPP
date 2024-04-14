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
                left: 'sixMonthsBack, sixMonthsForward',
                center: 'title',
                right: 'month'
            },
            defaultView: 'month',
            events: 'load_events.php',
            customButtons: {
                sixMonthsBack: {
                    text: '-6 mois',
                    click: function() {
                        var date = $('#calendar').fullCalendar('getDate');
                        $('#calendar').fullCalendar('gotoDate', date.subtract(6, 'months'));
                    }
                },
                sixMonthsForward: {
                    text: '+6 mois',
                    click: function() {
                        var date = $('#calendar').fullCalendar('getDate');
                        $('#calendar').fullCalendar('gotoDate', date.add(6, 'months'));
                    }
                }
            },
            dayClick: function(date, jsEvent, view) {
                // your existing dayClick function
            },
            eventClick: function(event, jsEvent, view) {
                // your existing eventClick function
            },
            eventRender: function(event, element) {
                // your existing eventRender function
            }
        });
    });
    </script>
</body>
</html>
