<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voir l'image</title>
</head>
<body>
    <h1>Votre score : <?php echo isset($_GET['score']) ? htmlspecialchars($_GET['score']) : 0; ?></h1>
    
    <!-- Vérifier si une image a été obtenue-->
    <?php if (isset($image_url) && !empty($image_url)): ?>
        <img src="<?php echo htmlspecialchars($image_url); ?>" alt="Image selon votre score">
    <?php else: ?>
        <p>Aucune image disponible pour ce score.</p>
    <?php endif; ?>

    <form method="get" action="../View/accueil.php">
        <input type="hidden" name="nom" value="<?php echo isset($_GET['nom']) ? htmlspecialchars($_GET['nom']) : 'visiteur'; ?>">
        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : 0; ?>"></input>
        <button type="submit">Retour à l'accueil</button>
    </form>
</body>
</html>
