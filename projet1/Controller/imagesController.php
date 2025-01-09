<?php
include_once '../Model/imagesModel.php';
include_once 'session.php';

class ImageController {
    private $model;

    public function __construct() {
        $this->model = new ImageModel();
    }

    public function getImage($id) {
        $images_obtenues = $this->model->images_obtenues($id);
        include '../View/profil.php';
        
    }


    public function displayImage($score, $id, $nom) {
        echo 'passage dans fonction displayImages controller';
        echo $score;
        echo $nom;
        
        $image_url = '';

        if ($score == 0) {
            $image_url = '../images/image0pt.jpeg'; 
            $numero = 1;
        } elseif ($score == 5) {
            $image_url = '../images/imageSUP5pt.jpeg'; 
            $numero = 2;
        }elseif ($score == 10) {
            $image_url = '../images/imageSUP10pt.jpeg'; 
            $numero = 3;
        }elseif ($score == 15) {
            $image_url = '../images/imageSUP30pt.jpeg'; 
            $numero = 4;
        }elseif ($score == 20) {
            $image_url = '../images/OIP (1).jpeg'; 
            $numero = 5;
        }elseif ($score == 25) {
            $image_url = '../images/OIP (2).jpeg'; 
            $numero = 6;
        }elseif ($score == 30) {
            $image_url = '../images/OIP (3).jpeg'; 
            $numero = 7;
        }elseif ($score == 35) {
            $image_url = '../images/OIP (4).jpeg'; 
            $numero = 8;
        }elseif ($score == 40) {
            $image_url = '../images/OIP (5).jpeg'; 
            $numero = 9;
        }elseif ($score == 45) {
            $image_url = '../images/OIP (6).jpeg'; 
            $numero = 10;
        }elseif ($score == 50) {
            $image_url = '../images/OIP (7).jpeg'; 
            $numero = 11;
        }elseif ($score == 49) {
            $image_url = '../images/OIP.jpeg'; 
            $numero = 12;
        }elseif ($score == 11) {
            $image_url = '../images/télécharger (1).jpeg'; 
            $numero = 13;
        }elseif ($score == 22) {
            $image_url = '../images/télécharger (3).jpeg'; 
            $numero = 14;
        }elseif ($score == 33) {
            $image_url = '../images/télécharger.jpeg'; 
            $numero = 15;
        }elseif ($score == 44) {
            $image_url = '../images/OIP (8).jpeg'; 
            $numero = 16;
        }elseif ($score == 27) {
            $image_url = '../images/télécharger (2).jpeg'; 
            $numero = 17;
        }elseif ($score == 37) {
            $image_url = '../images/ticket.jpeg'; 
            $numero = 18;
        }elseif ($score == 47) {
            $image_url = '../images/télécharger (4).jpeg'; 
            $numero = 19;
        }elseif ($score == 26) {
            $image_url = '../images/télécharger (5).jpeg'; 
            $numero = 20;
        } else {
            $image_url = ''; 
        }

        $image_obtenue = $this->model->image_obtenue($image_url, $id);

        if(!$image_obtenue && $image_url != ''){
            echo "pas d'image";
            echo $id;
            $sauvegarde_image = $this->model->sauvegarde_image($image_url, $id, $numero);
        }else{
            $image_url = '';
        }
        
        include '../View/fin_questionnaire.php';
    }

}
?>
