<?php
    include_once '../Model/questionModel.php';
    include_once 'session.php';
    class QuestionController{
        private $model;

        public function __construct(){
            $this->model = new QuestionModel;
        }

        function logout()
         {
            unset($_SESSION['tab_question']);
            $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $nom = isset($_GET['nom']) ? $_GET['nom'] : 'visiteur';
            header("Location: ../View/accueil.php?nom=$nom&id=$id");
            exit;
         }


        function debutQuestionnaire(){

            unset($_SESSION['message'], $_SESSION['fin_questionnaire']);

            if (!isset($_SESSION['user']['id']) || !$_SESSION['user']['logged_in']) {
                $_SESSION['message'] = "Vous devez être connecté pour commencer le questionnaire.";
                header("Location: ../View/accueil.php");
                exit;
            }

            if (!isset($_SESSION['tab_question']) || empty($_SESSION['tab_question'])) {
                $questions = $this->model->getAllQuestions();
                if (empty($questions)) {
                    $_SESSION['message'] = "Aucune question disponible. Veuillez vérifier la base de données.";
                    header("Location: ../View/accueil.php");
                    exit;
                }
                $_SESSION['tab_question'] = array_column($questions, 'id_question');
                $_SESSION['score'] = 0;
                $_SESSION['fin_questionnaire'] = false; // Réinitialiser si nécessaire
            }
            
            if(!empty($_SESSION['tab_question'])){
                $tab_rand = array_rand($_SESSION['tab_question']);
                $question_id = $_SESSION['tab_question'][$tab_rand];
                unset($_SESSION['tab_question'][$tab_rand]);

                $question = $this->model->getQuestion($question_id);
                include '../View/questionnaire.php';
            }else{
                $_SESSION['message'] = "Votre score est " . $_SESSION['score'];
                header('Location: ../View/accueil.php');
                exit;
            }
        }

        function verifieReponse(){
            $question_id = $_POST['id_question'];
            $reponse = $_POST['reponse'];
            $nom = $_GET['nom'];
            $id = $_GET['id'];

            $question = $this->model->getQuestion($question_id);
            $bonne_reponse = $question['vraieReponse'];

            if($bonne_reponse === $reponse){
                $_SESSION['score']++;
                $_SESSION['message'] = "Bonne réponse ! Votre score est de : " . $_SESSION['score'];
            }else{
                $_SESSION['message'] = "Mauvaise réponse ! La bonne réponse était : $bonne_reponse. Votre score final est : " . $_SESSION['score'];
                unset($_SESSION['tab_question']);
            }

            if(empty($_SESSION['tab_question'])){
                $this->model->updateScore($_SESSION['user']['id'], $_SESSION['score']);
                $ligne_score_max = $this->model->score_maxi($_SESSION['user']['id']);
                $score_max = $ligne_score_max['score_max'];
                if($_SESSION['score'] > $score_max){
                    $score_max = $this->model->updateScoreMaxi($_SESSION['user']['id'], $_SESSION['score']);
                }
                $_SESSION['fin_questionnaire'] = true;
                // ---------------------------------------------------
                header('Location: routes.php?page=displayImage&score='.$_SESSION['score'].'&id='.$id.'&nom='.$nom);
                exit;
            }
            $this->debutQuestionnaire();
        }

    }
?>