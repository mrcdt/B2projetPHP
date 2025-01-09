<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/cours/coursPHP/projet/projet1/View/accueil.css">
    <title>Accueil</title>
</head>
<body>
    <nav class="menu">
        <h2 class="sous-titre"> Bonjour <?php if(isset($_GET['nom'])){echo $_GET['nom'];}else{echo "visiteur";}?></h2>
        <h1 class="titre">Titanic Quizz</h1>
        <ul>
            <li><a href='../Controller/routes.php?page=profil&nom=<?php echo isset($_GET['nom']) ? $_GET['nom'] : 'visiteur'; ?>&id=<?php echo isset($_GET['id']) ? $_GET['id'] : 0; ?>' class="profil" >Profil</a></li>
            <li>
                <form method="POST" class="form_deconnexion" action="/cours/coursPHP/projet/projet1/Controller/routes.php">
                    <input type="hidden" name="action" value="accueil" class="accueil">
                    <button class="button" type="submit" name="logout" class="button_logout">Se déconnecter</button>
                </form>
            </li>
        </ul>
    </nav>

    <section class="corps">
        <div class="debut_question">
            <button onclick="window.location.href='../Controller/routes.php?page=questions&nom=<?php echo isset($_GET['nom']) ? $_GET['nom'] : 'visiteur1'; ?>&id=<?php echo isset($_GET['id']) ? $_GET['id'] : 0; ?>'" class="button">débuter le questionnaire</button><br>
        </div>
    </section>

</body>
</html>