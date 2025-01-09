<?php
    include_once '../Model/usersModel.php';
    include_once 'session.php';
    class UsersController{
        private $model;

        public function __construct(){
            $this->model = new UsersModel;
        }

        //pour se créer un profil avec vérification si username déjà existant
        function inscription_database($name, $password)
        {
            $users = $this->model->getUserByName($name);

            if ($users) {
                echo 'Ce nom est déjà utilisé. Veuillez en choisir un autre.';
                return;
            }
            $this->model->addUser($name, $password);
            header("Location: ../View/connexion.php");
        }

        //vérification du mot de passe inséré lors de l'inscription
        function verifie($name, $password)
        {
            echo "verifie";
            $majuscule = preg_match('@[A-Z]@', $password);
            $minuscule = preg_match('@[a-z]@', $password);
            $nombre = preg_match('@[0-9]@', $password);
            $special = preg_match('@[^\w]@', $password);

            if (strlen($name) < 3) {
                echo 'Votre nom est trop court';
            } elseif (!$majuscule || !$minuscule || !$nombre || !$special || strlen($password) < 12) {
                echo 'Votre mot de passe doit contenir au moins une majuscule, une minuscule, un nombre, un caractère spécial et faire au moins 12 caractères';
            } else {
                echo "database";
                $this->inscription_database($name, $password);
            }
        }

        //pour se connecter à son profil avec vérification du mot de passe   
        function connexion_database($name, $password)
        {
            echo "connexion database";
            $users = $this->model->getUserByName($name);

            if ($users) {
                echo "users";
                var_dump($password);
                var_dump($users['password']);
                if (password_verify($password, $users['password'])) {
                    $id = $users['id'];
                    echo "avant login";
                    login($name, $password, $id);
                }
            } else {
                echo 'Nom ou mot de passe incorrect';
            }
        }

         //pour se déconnecter
         function logout()
         {
             session_unset(); 
             session_destroy(); 
             header("Location: ../View/connexion.php");
         }
 

        public function getUser()
        {
            $users = $this->model->getUser();
        }

        public function getAllUsers()
        {
            // $users = $this->model->getAllUsers($name);
            // include_once 'view/session.php';
        }
        
        public function getUserByName()
        {
                    // Vérifie si le paramètre 'nom' est dans l'URL ou dans la session
            $nom = $_GET['nom'] ?? ($_SESSION['user']['name'] ?? null);

            if ($nom) {
                // Appelle le modèle pour récupérer l'utilisateur par le nom
                $users = $this->model->getUserByName($nom);
                return $users; // Retourne les informations de l'utilisateur
            } else {
                echo "Nom non trouvé dans l'URL ou la session.";
                return null;
            }
        }

    }
?>