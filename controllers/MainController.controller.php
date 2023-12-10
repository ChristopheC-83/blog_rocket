<?php
require_once("models/MainManager.model.php");
require_once("controllers/Tools.php");
require_once("controllers/Functions.php");

class MainController{
    private $mainManager;
    private $functions;
    public function __construct(){
        $this->mainManager = new MainManager();
        $this->functions = new Functions();
    }

    //Propriété "page_javascript" : tableau permettant d'ajouter des fichiers JavaScript spécifiques

    // Direction vers la parge d'accueil
    public function homePage(){
        Tools::alertMsg("Alert test", "alert-danger");
        $users = $this->mainManager->getUsers();
        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Titre de la page d'accueil",
            "view" => "views/pages/homePage.view.php",
            "users" => $users,
            "template" => "./views/common/template.php"
        ];
        $this->functions->generatePage($data_page);
    }

    

    // Direction vers la page d'erreur
    public function errorPage($msg){
        $data_page = [
            "page_description" => "Page permettant de gérer les erreurs",
            "page_title" => "Page d'erreur",
            "msg" => $msg,
            "view" => "./views/pages/errorPage.view.php",
            "template" => "views/common/template.php"
        ];
        $this->functions->generatePage($data_page);
    }
}