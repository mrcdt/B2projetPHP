<?php
include_once 'bdd.php';

class QuestionModel
{
    private $pdo;


    public function __construct()
    {
       $this->pdo = Bdd::connexion();
    }

    public function getAllQuestions()
    {
        $questions = $this->pdo->query("SELECT id_question FROM questions")->fetchAll(PDO::FETCH_ASSOC);
        return $questions;
    }

    public function getQuestion($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM questions WHERE id_question = ? ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    } 

    public function updateScore($user_id, $score){
        $query = $this->pdo->prepare("UPDATE users SET score = ? WHERE id = ?");
        $query->execute([$score, $user_id]);
    }

    public function score_maxi($id){
        $query = $this->pdo->prepare("SELECT score_max FROM users WHERE id = ? ");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function updateScoreMaxi($id, $score){
        $query = $this->pdo->prepare("UPDATE users SET score_max = ? WHERE id = ?");
        $query->execute([$score, $id]);
    }
    // public function getNbQuestions()
    // {
    //     return $this->pdo->query("SELECT COUNT('id_question') AS nb_questions FROM questions ")->fetch(PDO::FETCH_ASSOC);
    // }

}


?>

