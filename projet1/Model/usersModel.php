<?php
include_once 'bdd.php';

class UsersModel
{
    private $pdo;


    public function __construct()
    {
       $this->pdo = Bdd::connexion();
    }

    public function addUser($name, $password)
    {
        $sql2 = $this->pdo->prepare('INSERT INTO users (nom, password) VALUES (?, ?)');
        $sql2->execute([$name, password_hash($password, PASSWORD_DEFAULT)]);
    }

    public function getUser()
    {
        return $this->pdo->query("SELECT * FROM users ")->fetch(PDO::FETCH_ASSOC);
    }

    //récupération d'un user par le nom
    public function getUserByName($name)
    {
        $sql = $this->pdo->prepare('SELECT * FROM users WHERE nom = ?');
        $sql->execute([$name]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $sql = $this->pdo->prepare('SELECT * FROM produits WHERE id_produit = ?');
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_ASSOC);

    }


}


?>

