<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../View/profil.css">
    <title>Profil</title>
</head>
<body>
    <button onclick="window.location.href='../View/accueil.php?nom=<?php echo isset($_GET['nom']) ? $_GET['nom'] : 'visiteur'; ?>&id=<?php echo isset($_GET['id']) ? $_GET['id'] : 0; ?>'">retour</button><br>
    <img src="../profilLogo.png">
    <h2><?php if(isset($_GET['nom'])){echo $_GET['nom'];}else{echo "visiteur";}?></h2><br><br>
    

    <section id="images">
        <h1>Images récoltées</h1>
        <table>
        <?php 
                // Exemple de tableau des numéros de cellule pour une meilleure organisation
                $num_cells = range(1, 20); // Ajoutez autant de cellules que nécessaire
            
                echo "<tr>";
                foreach ($num_cells as $num) {

                    $found = false; // Indicateur pour savoir si une image correspond à cette cellule
                    if (isset($images_obtenues) && is_array($images_obtenues)) {
                        foreach ($images_obtenues as $image) {
                            // Vérifiez si une image correspond au numéro de la cellule et est obtenue
                            if ($image['obtenue'] == '1' && $image['num_image'] == (string)$num) {
                                echo "<td style=\"background-image: url('" . htmlspecialchars($image['url_image']) . "');\" class=\"cell-with-bg\"></td>";
                                $found = true;
                                break;
                            }
                        }
                    }
                    // Si aucune image n'est trouvée pour cette cellule
                    if (!$found) {
                        echo "<td><p>$num</p></td>";
                    }

                    if (($num) % 5 === 0 && $num !== count($num_cells)) {
                        echo "</tr><tr>"; // Fermer la ligne actuelle et ouvrir une nouvelle
                    }
                }
                echo "</tr>";
                ?>

        </table>
    </section>
</body>
</html>