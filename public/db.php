<?php
include 'db.php';  // Inclure le fichier de connexion à la base de données

// Vous pouvez maintenant utiliser $mysqli pour vos requêtes
$query = "SELECT * FROM conges";
$result = $mysqli->query($query);

if ($result) {
    // Traiter les résultats
    while ($row = $result->fetch_assoc()) {
        echo $row['description']; // Exemple d'accès à une colonne
    }
} else {
    echo "Erreur : " . $mysqli->error;
}

$mysqli->close();
?>
