<?php

// fichier avec des fonctions récurrentes
// importé par injection de dépendances dans chaque classe controller qui le nécessite

class Functions
{
    // cette fonction permet de récupérer les données sous forme d'un tableau dans les controllers 
    // pour en faire une page accessible à l'utilisateur .
    public function generatePage($data)
    {
        extract($data);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }
    // pour hasher et sécuriser les mdp utilisateurs avant envoi dans la DB
    public function hashFunction($psw)
    {
        $hashedPsw = password_hash($psw, PASSWORD_DEFAULT);
        return $hashedPsw;
    }

    // générer un mdp aléatoire au besoin
    public function generateRandomPassword($length = 20) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }

    
};
