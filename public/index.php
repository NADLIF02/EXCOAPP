<?php
session_start();

// Vérification de l'état de connexion pour rediriger les utilisateurs déjà connectés
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: calendrier.php");
    exit;
}

$error_message = '';  // Initialisation de la variable de message d'erreur

// Traitement du formulaire de connexion
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérification des identifiants (exemple simple)
    if ($username === "admin" && $password === "admin123") {
        // Définition des variables de session
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        // Redirection vers le calendrier
        header("Location: calendrier.php");
        exit;
    } else {
        // Connexion échouée, afficher un message d'erreur
        $error_message = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>EXCOAPP - Accueil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>EXCOAPP</h1>
            <p>Bienvenue sur notre site de gestion de congés!</p>
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="calendrier.php">Calendrier</a></li>
                </ul>
            </nav>
        </header>
        <section>
            <h2>Connexion</h2>
            <?php if (!empty($error_message)): ?>
                <p class="error"><?= $error_message ?></p>
            <?php endif; ?>
            <form action="index.php" method="post">
                <label for="username">Nom d'utilisateur:</label>
                <input type="text" id="username" name="username" required><br>
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" required><br>
                <input type="submit" name="login" value="Se connecter">
            </form>
        </section>
    </div>
</body>
</html>
