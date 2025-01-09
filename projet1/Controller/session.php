<?php 

session_start();

// Initialisation de la session si elle n'existe pas
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = [
        'id' => null,
        'password'=> null,
        'name' => null,
        'logged_in' => false,
        'score_max' => null
    ];
}

//initialisation de la session en fonction du user
function login($name, $password, $id)
{
    $_SESSION["user"]["id"] = $id;
    $_SESSION["user"]["password"] = $password;
    $_SESSION['user']['name'] = $name;
    $_SESSION['user']['logged_in'] = true;
    header("Location: ../View/accueil.php?nom=$name&id=$id");
}


?>

