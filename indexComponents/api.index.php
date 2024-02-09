<?php

// afin de ne pas avoir un index.php à rallonge, 
// ici, la partie api

switch ($url[1]) {
        //  accés à la page de profil
    case "all_articles":
        $visitorController->sendApiArticles();
        break;


    default:
        throw new Exception("La page demandée n'existe pas...");
}
