<?php 

$nom = isset($_GET['nom']) ? $_GET['nom'] : (isset($_POST['nom']) ? $_POST['nom'] : 'visiteur');
$page = (isset($_GET['page'])) ? $_GET['page'] : 'null';
$action = isset($_POST['action']) ? $_POST['action'] : null;

if ($action) {
    $route = $action; // Priorité à l'action si elle existe souvent situé dans les formes
} elseif ($page) {
    $route = $page; // Sinon, utiliser la page car je l'utilise souvent dans les url
} else {
    $route = 'accueil'; // Par défaut, rediriger vers l'accueil
}

switch($route)
{
    case 'accueil':
        include_once 'usersController.php';
        $objet = new UsersController;
        if (isset($_POST['logout'])){
            $objet->logout(); //permettra de se déconnecter si le bouton de la page accueil est cliqué
        }
        $objet->getUserByName();
        include '../View/accueil.php'; 
        break;
    case 'inscription':
        include_once 'usersController.php';
        $objet = new UsersController;
        $objet->verifie($_POST['name'], $_POST['password']); //vérifier les champs insérés
        break;
    case 'connexion':
        include_once 'usersController.php';
        $objet = new UsersController;
        $objet->connexion_database($_POST['name'], $_POST['password']); //permet de comparer les champs insérés avec ceux dans la base de données
        break;
    case 'questions':
        include_once 'questionController.php';
        $objet = new QuestionController;
        $objet->debutQuestionnaire(); //fonction permettant de réaliser le questionnaire
        break;
    case 'verifieReponse':
        include_once 'questionController.php';
        $objet = new QuestionController;
        $objet->verifieReponse(); //permet de vérifier la réponse que l'utilisatera a choisi pour la question
        break;
    case 'profil':
        include_once 'imagesController.php';
        $objet = new ImageController;
        $objet->getImage($_GET['id']);
        break;
    case 'displayImage':
        include_once 'imagesController.php';
        $objet = new ImageController;
        $objet->displayImage($_GET['score'], $_GET['id'], $_GET['nom']);
        break; 
    default :
        include 'View/404.php';
}
?>