<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Gestion des Sessions</title>
</head>

<body class="body">

        <h1 class="titre">Se connecter</h1>
        <form action="/cours/coursPHP/projet/projet1/Controller/routes.php" method="POST" class="form_login">
            <p class="sous-titre">Se connecter</p><br>
            <input type="hidden" name="action" value="connexion" class="connexion">
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" class="name" required><br>
            <label for="name">Mot de passe :</label>
            <input type="text" name="password" id="password" class="password" required><br>
            <button class="button" type="submit">Se connecter</button>

            <hr class="divider"> <!-- trait décoratif -->
            <p class="sous-titre">Créer un compte</p><br>
            <button class="button" type="button" onclick="window.location.href='inscription.php';">Inscription</button>
        </form>

</body>

</html>
