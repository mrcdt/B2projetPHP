
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../View/style.css">
    <title>Gestion des Sessions</title>
</head>

<body class="body">
    
    <form method="get" action="../View/accueil.php">
        <input type="hidden" name="nom" value="<?php echo isset($_GET['nom']) ? $_GET['nom'] : 'visiteur'; ?>">
        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : 0; ?>">
        <button type="submit">Retour à l'accueil</button>
    </form>
    
    <?php if(isset($question)) : ?>
        <form method="post" action="routes.php?nom=<?php echo isset($_GET['nom']) ? $_GET['nom'] : 'visiteur'; ?>&id=<?php echo isset($_GET['id']) ? $_GET['id'] : 0; ?>">
            <input type="hidden" name="action" value="verifieReponse">
            <input type="hidden" name="id_question" value="<?php echo $question['id_question']; ?>">

            <p><strong>Question : </strong><?php echo htmlspecialchars($question['question']);?></p>
            <input type="hidden" name="id_question" value="<?php echo $question['id_question']; ?>">

            <label>
                <input type="radio" name="reponse" value="<?php echo htmlspecialchars($question['reponseA']); ?>" required>
                <?php echo htmlspecialchars($question['reponseA']); ?>
            </label><br>

            <label>
                <input type="radio" name="reponse" value="<?php echo htmlspecialchars($question['reponseB']); ?>" required>
                <?php echo htmlspecialchars($question['reponseB']); ?>
            </label><br>

            <label>
                <input type="radio" name="reponse" value="<?php echo htmlspecialchars($question['reponseC']); ?>" required>
                <?php echo htmlspecialchars($question['reponseC']); ?>
            </label><br>

            <label>
                <input type="radio" name="reponse" value="<?php echo htmlspecialchars($question['reponseD']); ?>" required>
                <?php echo htmlspecialchars($question['reponseD']); ?>
            </label><br>


            <button type="submit">Valider</button>
        </form>
    <?php else : ?>
        <p>Pas de  question disponible.</p>
    <?php endif; ?>
    
    <p><?php echo $_SESSION['user']['name']?>, votre score actuel est de : <?php echo $_SESSION['score'] ?? 0; ?></p>
</body>

</html>