<?php
session_start();
require_once '/var/www/src/db.php';  // Assurez-vous que le chemin d'accès est correct

// Gestion de l'ajout de congés via une requête POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $start = date('Y-m-d', strtotime($_POST['start']));
    $end = date('Y-m-d', strtotime($_POST['end']));
    $username = $_SESSION['username'] ?? 'DefaultUser';  // Utilisez une valeur par défaut ou assurez-vous que la session est toujours active

    $query = "INSERT INTO conges (username, description, start_date, end_date) VALUES (?, ?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    if ($stmt) {
        $stmt->bind_param("ssss", $username, $title, $start, $end);
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Congé ajouté avec succès']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout du congé: ' . $stmt->error]);
        }
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur de préparation de la requête']);
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
                events: '/load_events.php'  // URL du fichier de chargement des événements
            });
        });
    </script>
</body>
</html>
