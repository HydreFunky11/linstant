<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - L'Instant</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Inscription</h1>
    </header>

    <main>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $serveur = "localhost";
            $nom_utilisateur = "root"; // Nom d'utilisateur MySQL
            $mot_de_passe = ""; // Mot de passe MySQL
            $nom_base_de_donnees = "l'instant"; // Nom de la base de données MySQL

            // Connexion à la base de données
            $connexion = mysqli_connect($serveur, $nom_utilisateur, $mot_de_passe, $nom_base_de_donnees);

            if (!$connexion) {
                die("La connexion à la base de données a échoué : " . mysqli_connect_error());
            }

            // Validation des données (ajoutez vos propres validations ici)

            // Hachage du mot de passe
            $motdepasse_hashed = password_hash($_POST['motdepasse'], PASSWORD_DEFAULT);

            // Requête SQL d'insertion
            $query = "INSERT INTO user (nom, prenom, email, motdepasse) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($connexion, $query);
            mysqli_stmt_bind_param($stmt, "ssss", $_POST['nom'], $_POST['prenom'], $_POST['email'], $motdepasse_hashed);

            // Exécution de la requête
            if (mysqli_stmt_execute($stmt)) {
                echo "Inscription réussie !";
            } else {
                echo "Erreur lors de l'inscription : " . mysqli_error($connexion);
            }
            header("Location: login.php");
            // Fermeture de la connexion
            mysqli_close($connexion);
        }
        ?>

        <form action="register.php" method="post">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required>
            
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required>
            
            <label for="email">Adresse e-mail :</label>
            <input type="email" id="email" name="email" required>
            
            <label for="motdepasse">Mot de passe :</label>
            <input type="password" id="motdepasse" name="motdepasse" required>
            
            <input type="submit" value="S'inscrire">
        </form>
    </main>

    <footer>
        <p>&copy; 2023 L'Instant - Tous droits réservés</p>
    </footer>
</body>
</html>
