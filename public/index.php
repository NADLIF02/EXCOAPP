<?php
session_start();
require_once '/var/www/src/db.php'; 

// Redirection si déjà connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: calendrier.php");
    exit;
}

$error_message = '';

if (isset($_POST['login'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if (empty($username) || empty($password)) {
        $error_message = "Veuillez remplir tous les champs.";
    } else {
        // Préparez ici votre requête à la base de données pour vérifier les identifiants
        $stmt = $db->prepare("SELECT id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            // Vérifiez le mot de passe (supposons que les mots de passe sont hachés)
            if (password_verify($password, $user['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username'];
                header("Location: calendrier.php");
                exit;
            } else {
                $error_message = "Mot de passe incorrect.";
            }
        } else {
            $error_message = "Nom d'utilisateur introuvable.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>EXCOAPP - Connexion</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h1>Connexion à EXCOAPP</h1>
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
    </div>
</body>
</html>
