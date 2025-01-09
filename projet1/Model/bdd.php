<?php

class Bdd {
    public static function connexion(){
        $dsn = 'mysql:host=localhost;dbname=projet1;charset=utf8mb4';
        $user = 'root';
        $pass = '';

        // Vérifier connexion à la base de données
        try {
            $pdo = new PDO($dsn, $user, $pass);
            return $pdo;
        } catch (PDOException $e) {
            die("Échec de la connexion : " . $e->getMessage());
        }
    }
}
?>