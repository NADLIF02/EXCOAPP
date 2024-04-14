<?php
// Connexion à la base de données
// Remplacez les valeurs ci-dessous par vos informations de connexion réelles
$db = new PDO('mysql:host=localhost;dbname=nom_de_votre_base', 'utilisateur', 'mot_de_passe');

// Sélectionner les événements de la base de données
$stmt = $db->prepare("SELECT id, title, start_date AS start, end_date AS end FROM conges");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Envoyer les résultats en JSON pour FullCalendar
echo json_encode($results);
?>
