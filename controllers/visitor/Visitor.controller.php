<?php

// Classe des pages/fonctions propres à l'utilisateur connecté (ou en cours de connection/inscription) 

require_once("./controllers/MainController.controller.php");
require_once("./models/Visitor/Visitor.model.php");
require_once("./models/Visitor/Visitor.model.php");

class VisitorController extends MainController
{
    public $visitorManager;
    public $functions;
    public function __construct()
    {
        $this->functions = new Functions();
        $this->visitorManager = new VisitorManager();
    }


    // Direction vers la parge d'accueil
    public function homePage()
    {
        $psw=$this->functions->hashFunction("*Santa30420*");
        // Tools::alertMessage("Alert test", "alert-danger");
        $users = $this->visitorManager->getUsers();
        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Titre de la page d'accueil",
            "view" => "views/pages/visitor/homePage.view.php",
            "psw" => $psw,
            "users" => $users,
            "template" => "./views/common/template.php"
        ];
        $this->functions->generatePage($data_page);
    }
    // connexion
    public function connectionPage()
    {
        $data_page = [
            "page_description" => "Page de connexion",
            "page_title" => "Page de connexion",
            "javascript" => ['loader.js'],
            "title_page" => "Connexion",
            "view" => "views/pages/Visitor/connectionPage.view.php",
            "template" => "./views/common/template.php"
        ];
        $this->functions->generatePage($data_page);
    }
    // création compte
    public function registrationPage()
    {
        $data_page = [
            "page_description" => "Page de création de compte",
            "page_title" => "Page de création de compte",
            "jsm" => ['loader.js'],
            "title_page" => "Création de votre compte.",
            "view" => "views/pages/Visitor/registrationPage.view.php",
            "template" => "views/common/template.php",
        ];
        $this->functions->generatePage($data_page);
    }



    //  page avec les article pour un theme choisi
    // public function themePage($theme)
    // {
    //     $themePage = $this->visitorArticlesManager->chosenTheme($theme);
    //     $articlesFromTheme = $this->visitorArticlesManager->articlesFromTheme($theme);

    //     $data_page = [
    //         "meta_description" => "Partage d'expérience : ... ",
    //         "page_title" => "repaire d'un dev !",
    //         "view" => "views/Visitor/themePage.view.php",
    //         "template" => "views/templates/template.php",
    //         "js" => ['home_page_animated_grid.js'],
    //         "themePage" => $themePage,
    //         "articlesFromTheme" => $articlesFromTheme,
    //     ];
    //     $this->functions->generatePage($data_page);
    // }


    // Direction vers la page d'erreur
    public function errorPage($msg)
    {
        $data_page = [
            "page_description" => "Page permettant de gérer les erreurs",
            "page_title" => "Page d'erreur",
            "msg" => $msg,
            "view" => "./views/pages/visitor/errorPage.view.php",
            "template" => "views/common/template.php"
        ];
        $this->functions->generatePage($data_page);
    }

    
}
