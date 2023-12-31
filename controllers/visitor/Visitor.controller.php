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
            "texte_1_page" => "Autour du code",
            "texte_2_page" => "Partageons, échangeons !",
            "title_page" => "Seul on va plus vite, ensemble on va plus loin !",
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
            "texte_1_page" => "Et si tu n'es pas inscrit(e),",
            "texte_2_page" => " ⏬ C'est par là aussi ! ⏬ ",
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
            "texte_1_page" => "Nous n'attendions que toi !",
            "texte_2_page" => "Installe toi à ton aise 😉 ",
            "title_page" => "Création de ton compte.",
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
            
            "texte_1_page" => "On est perdu ?",
            "texte_2_page" => "Retour à l'accueil et c'est reparti !",
            "page_title" => $msg,
            "msg" => $msg,
            "view" => "./views/pages/visitor/errorPage.view.php",
            "template" => "views/common/template.php"
        ];
        $this->functions->generatePage($data_page);
    }

    
}
