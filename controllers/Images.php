<?php

// fichier avec des fonctions récurrentes concernant la gestion des images et médias
// importé par injection de dépendances dans chaque classe controller qd besoin travail avec médias
require_once("./controllers/admin/Administrator.controller.php");
class Images
{

    public $administratorManager;

    public function __construct()
    {
        $this->administratorManager = new AdministratorManager();
    }

    // vider le dossier des médias de l'article s'il y a qq chose dedans
    public function eraseFolderContent($id_article)
    {
        $folder = MEDIA_PATH . $id_article;
        $files = glob($folder . '/*');
        foreach ($files as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }
    }

    // ajoute une image dans un dossier cible créé s'il n'existe pas
    function add_image($id_article, $file)
    {
        //     Tools::showArray($file);
        //     Tools::showArray($file);
        //     Tools::showArray($id_article);
        // Il faut séléctionner une image
        if (!isset($file['name']) || empty($file['name'])) {
            throw new Exception("Vous devez sélectionner une image.");
        }
        //  on cible le dossier recepteur
        $final_folder = MEDIA_PATH . $id_article . "/";

        if (!file_exists($final_folder)) mkdir($final_folder, 0777);
        
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $target_file =  $final_folder . $file['name'];
        // test sur l'image (taille, extension, nom, nmo unique)
        if (!getimagesize($file["tmp_name"]))
            throw new Exception("Le fichier n'est pas une image");
        if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
            throw new Exception("L'extension du fichier n'est pas reconnu");
        if (file_exists($file['name']))
            throw new Exception("Le fichier existe déjà.");
        if ($file['size'] > 750000)
            throw new Exception("Le fichier est trop volumineux (500ko maximum).");
        // vidage dossier de l'article
        $this->eraseFolderContent($id_article);
        // vidage img1 / slider / video en bdd
        $this->administratorManager->eraseMedia($id_article);
        // upload de l'image dans le dossier
        if (!move_uploaded_file($file['tmp_name'], $target_file))
            throw new Exception("l'ajout de l'image n'a pas fonctionné");

        else return ($file['name']);
    }

    // ajout d'un slider dans un dossier cible créé s'il n'existe pas
    // comme pour l'image, mais en plusieurs itérations.
    function add_slider($id_article, $file)
    {
        // Tools::showArray($file);
        // Tools::showArray($id_article);
        $lengthArray = count($file['name']);
        $final_folder = MEDIA_PATH . $id_article . "/";
        // echo "<br>";
        // echo $final_folder;

        for ($i = 0; $i < $lengthArray; $i++) {
            $target_file = $final_folder . basename($file['name'][$i]);
            if (!isset($file['name'][$i]) || empty($file['name'][$i])) {
                throw new Exception("Vous devez sélectionner une image.");
            }
            if (!file_exists($final_folder)) mkdir($final_folder, 0777);
            $extension = strtolower(pathinfo($file['name'][$i], PATHINFO_EXTENSION));
            $target_file =  $final_folder . $file['name'][$i];
            if (!getimagesize($file["tmp_name"][$i]))
                throw new Exception("Le fichier n'est pas une image");
            if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
                throw new Exception("L'extension du fichier n'est pas reconnu");
            if ($file['size'][$i] > 750000)
                throw new Exception("Le fichier est trop volumineux (500ko maximum).");
            if (!move_uploaded_file($file['tmp_name'][$i], $target_file))
                throw new Exception("l'ajout de l'image n'a pas fonctionné");
        }
        return $final_folder;
    }
}
