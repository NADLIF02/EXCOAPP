<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Bienvenue sur notre site de gestion de congés!</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="calendrier.php">Calendrier</a></li>
            </ul>
        </nav>
    </header>
    <section>
        <h2>Connexion</h2>
        <form action="index.php" method="post">
            Nom d'utilisateur: <input type="text" name="username"><br>
            Mot de passe: <input type="password" name="password"><br>
            <input type="submit" name="login" value="Se connecter">
        </form>
    </section>
    <?php
        if (isset($_POST['login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            // Vérification des identifiants (exemple simple)
            if ($username == "admin" && $password == "admin123") {
                // Connexion réussie, redirection vers le calendrier
                header("Location: calendrier.php");
            } else {
                // Connexion échouée, afficher un message d'erreur
                echo "<p style='color:red;'>Nom d'utilisateur ou mot de passe incorrect.</p>";
            }
        }
    ?>
</body>
</html>
