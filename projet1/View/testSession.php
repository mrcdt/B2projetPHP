<?php 

session_start();

// Initialisation de la session si elle n'existe pas
if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = [
        'id' => null,
        'password'=> null,
        'name' => null,
        'logged_in' => false,
    ];
}

//pour se connecter à son profil avec vérification du mot de passe
function connexion_database($name, $password, $pdo)
{
    $sql = $pdo->prepare('SELECT * FROM users WHERE name = :name');
    $sql->execute(['name' => $name]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        if (password_verify($password, $result['password'])) {
            $id = $result['id'];
            login($name, $password, $id);
        }
    } else {
        echo 'Nom ou mot de passe incorrect';
    }
}

//initialisation de la session en fonction du user
function login($name, $password, $id)
{
    $_SESSION["user"]["id"] = $id;
    $_SESSION["user"]["password"] = $password;
    $_SESSION['user']['name'] = $name;
    $_SESSION['user']['logged_in'] = true;
}

//pour se créer un profil avec vérification si username déjà existant
function inscription_database($name, $password, $pdo)
{
    $sql = $pdo->prepare('SELECT * FROM users WHERE name = :name');
    $sql->execute(['name' => $name]);
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    echo $result;

    if ($result) {
        echo 'Ce nom est déjà utilisé. Veuillez en choisir un autre.';
        return;
    }

    $sql2 = $pdo->prepare('INSERT INTO users (name, password) VALUES (:name, :password)');
    $sql2->execute(['name' => $name, 'password'=> password_hash($password, PASSWORD_DEFAULT)]);
    header("Location: connexion.php");
}

//vérification du mot de passe inséré lors de l'inscription
function verifie($name, $password, $pdo)
{
    $majuscule = preg_match('@[A-Z]@', $password);
    $minuscule = preg_match('@[a-z]@', $password);
    $nombre = preg_match('@[0-9]@', $password);
    $special = preg_match('@[^\w]@', $password);

    if (strlen($name) < 3) {
        echo 'Votre nom est trop court';
    } elseif (!$majuscule || !$minuscule || !$nombre || !$special || strlen($password) < 12) {
        echo 'Votre mot de passe doit contenir au moins une majuscule, une minuscule, un nombre, un caractère spécial et faire au moins 12 caractères';
    } else {
        inscription_database($name, $password, $pdo);
    }
}

//pour se déconnecter
function logout()
{
    session_unset(); 
    session_destroy(); 
}

//vérifier quel bouton a été cliqué
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'connexion') {
        $nom = $_POST['name'];
        $password = $_POST['password'];
        connexion_database($nom, $password, $pdo);
    } elseif($_POST['action'] === 'inscription'){
        $nom = $_POST['name'];
        $password = $_POST['password'];
        verifie($nom, $password, $pdo);
    } elseif ($_POST['action'] === 'logout') {
        logout();
    }
}

?>

