<?php

// fichier avec des fonctions récurrentes
// importé par injection de dépendances dans chaque classe controller qd besoin travail médias

class Images
{


    
function add_image($file, $id_article)
{

    if (!isset($file['name']) || empty($file['name'])) {
        throw new Exception("Vous devez sélectionner une image.");
    }
    $folder = MEDIA_PATH . $id_article . "/";
    if (!file_exists($folder)) mkdir($folder, 0777);

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $target_file =  $folder . $file['name'];

    if (!getimagesize($file["tmp_name"]))
        throw new Exception("Le fichier n'est pas une image");
    if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
        throw new Exception("L'extension du fichier n'est pas reconnu");
    if (file_exists($file['name']))
        throw new Exception("Le fichier existe déjà.");
    if ($file['size'] > 750000)
        throw new Exception("Le fichier est trop volumineux (500ko maximum).");
    if (!move_uploaded_file($file['tmp_name'], $target_file))
        throw new Exception("l'ajout de l'image n'a pas fonctionné");
    
    else return ($file['name']);
}
    function add_slider($file, $id_article)
    {
        $lengthArray = count($file['name']);
        $folder = MEDIA_PATH . $id_article;
        // $repertoire = sliderPath . $post['theme'] . "/" . $post['slider'] . "/";
    
        for ($i = 0; $i < $lengthArray; $i++) {
            $target_file = $folder . basename($file['name'][$i]);
            if (!isset($file['name'][$i]) || empty($file['name'][$i])) {
                throw new Exception("Vous devez sélectionner une image.");
            }
    
            if (!file_exists($folder)) mkdir($folder, 0777);
    
            $extension = strtolower(pathinfo($file['name'][$i], PATHINFO_EXTENSION));
            $target_file =  $folder . $file['name'][$i];
    
            if (!getimagesize($file["tmp_name"][$i]))
                throw new Exception("Le fichier n'est pas une image");
            if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
                throw new Exception("L'extension du fichier n'est pas reconnu");
            if ($file['size'][$i] > 750000)
                throw new Exception("Le fichier est trop volumineux (500ko maximum).");
            if (!move_uploaded_file($file['tmp_name'][$i], $target_file))
                throw new Exception("l'ajout de l'image n'a pas fonctionné");
        }
    
    }
}