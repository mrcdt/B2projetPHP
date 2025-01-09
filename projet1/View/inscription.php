<link rel="stylesheet" href="./style.css">

<body class="body">
    <h1 class="titre">Créer un compte</h1>

        <form action="/cours/coursPHP/projet/projet1/Controller/routes.php" method="POST" class="form_login">
            <p class="sous-titre">Créer un compte</p><br>
            <input type="hidden" name="action" value="inscription" class="inscription">

            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" class="name" required><br>
            <label for="name">Mot de passe :</label>
            <input type="text" name="password" id="password" class="password" required><br>
            <button class="button" type="submit">Créer</button>
            <hr class="divider">
            <p class="sous-titre">Se connecter</p><br>
            <button class="button" type="button" onclick="window.location.href='connexion.php';">Connexion</button>
        </form>
</body>

