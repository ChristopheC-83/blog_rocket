<?php
require_once("models/MainManager.model.php");
require_once("controllers/Toolbox.php");
require_once("controllers/Functions.php");

class MainController{
    private $mainManager;
    private $functions;

    public function __construct(){
        $this->mainManager = new MainManager();
        $this->functions = new Functions();
    }

    private function genererPage($data){
        extract($data);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }

    //Propriété "page_css" : tableau permettant d'ajouter des fichiers CSS spécifiques
    //Propriété "page_javascript" : tableau permettant d'ajouter des fichiers JavaScript spécifiques
    public function homePage(){
        // Toolbox::ajouterMessageAlerte("test", Toolbox::COULEUR_VERTE);

        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Titre de la page d'accueil",
            "view" => "views/pages/homePage.view.php",
            "template" => "./views/common/template.php"
        ];
        $this->functions->generatePage($data_page);
    }

    public function pageErreur($msg){
        $data_page = [
            "page_description" => "Page permettant de gérer les erreurs",
            "page_title" => "Page d'erreur",
            "msg" => $msg,
            "view" => "./views/pages/erreur.view.php",
            "template" => "views/common/template.php"
        ];
        $this->functions->generatePage($data_page);
    }
}