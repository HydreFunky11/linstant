<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - L'Instant</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Connexion</h1>
    </header>

    <main>
        <?php
        session_start(); // Démarrez une session pour gérer la connexion

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Vérifiez les informations d'authentification ici
            $nom_utilisateur_valide = "votre_nom_utilisateur"; // Remplacez par le nom d'utilisateur valide
            $motdepasse_valide = "votre_mot_de_passe"; // Remplacez par le mot de passe valide

            $nom_utilisateur = $_POST['nom_utilisateur'];
            $motdepasse = $_POST['motdepasse'];

            if ($nom_utilisateur == $nom_utilisateur_valide && $motdepasse == $motdepasse_valide) {
                // Authentification réussie
                $_SESSION['utilisateur_connecte'] = true;
                header("Location: main.php"); // Redirige vers la page principale après la connexion
                exit();
            } else {
                // Authentification échouée
                echo "Nom d'utilisateur ou mot de passe incorrect.";
            }
            header("Location: main.php");
        }
        ?>

        <form action="login.php" method="post">
            <label for="nom_utilisateur">adresse mail :</label>
            <input type="text" id="nom_utilisateur" name="nom_utilisateur" required>
            
            <label for="motdepasse">Mot de passe :</label>
            <input type="password" id="motdepasse" name="motdepasse" required>
            
            <input type="submit" value="Se connecter">
        </form>
    </main>

    <footer>
        <p>&copy; 2023 L'Instant - Tous droits réservés</p>
    </footer>
</body>
</html>
