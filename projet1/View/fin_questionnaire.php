<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(isset($_SESSION['message'])) : ?>
        <p><? echo htmlspecialchars($_SESSION['message']); ?></p>
    <?php endif; ?>

    <p><strong>Votre score actuel : </strong><?php echo isset($_SESSION['score']) ? $_SESSION['score'] : 0; ?></p>

    <p>Image reçu : </p><br>
    <!-- Vérifier si l'URL de l'image est définie avant de l'afficher -->
    <?php if (isset($image_url) && !empty($image_url)): ?>
        <img src="<?php echo htmlspecialchars($image_url); ?>" alt="Image selon votre score">
    <?php else: ?>
        <p>Aucune image disponible pour ce score.</p>
    <?php endif; ?>

    <form method="get" action="../View/accueil.php">
        <input type="hidden" name="nom" value="<?php echo isset($_GET['nom']) ? $_GET['nom'] : 'visiteur'; ?>">
        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : 0; ?>"></input>
        <button type="submit">Retour à l'accueil</button>
    </form>

    
</body>
</html>