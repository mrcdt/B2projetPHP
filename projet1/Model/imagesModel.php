<?php
include_once 'bdd.php';

class ImageModel {
    private $pdo;

    public function __construct() {
        $this->pdo = Bdd::connexion();
    }

    public function images_obtenues($id){
        $query = $this->pdo->prepare("SELECT * FROM images WHERE obtenue = 1 AND id_user = ?");
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function image_obtenue($img, $id){
        $query = $this->pdo->prepare("SELECT * FROM images WHERE url_image = ? AND id_user = ?");
        $query->execute([$img, $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function sauvegarde_image($img, $id, $numero){
        $query = $this->pdo->prepare("INSERT INTO images (url_image, num_image, id_user, obtenue) VALUES (?, ?, ?, ?)");
        $query->execute([$img, $numero, $id, 1]);
    }
}
?>
