<?php

// Classe des possibilités pour un utilisateur connecté en tant qu'administrateur

require_once("./controllers/Functions.php");
require_once("./models/Admin/Administrator.model.php");
require_once("./controllers/MainController.controller.php");
require_once("./controllers/user/User.controller.php");
// require_once("./controllers/Images.controller.php");

class EditorController extends MainController
{
    public $functions;
    public $administratorManager;
    // public $imageController;
    public function __construct()
    {
        $this->functions = new Functions();
        $this->administratorManager = new AdministratorManager();
    }

    public function deleteTheme($id_theme)
    {
        if ($this->administratorManager->deleteThemeDB($id_theme)) {
            Tools::alertMessage("Succés de la suppression du thème", "alert-success");
        } else {
            Tools::alertMessage("Echec de la suppression du thème", "alert-danger");
        }
        header('Location: ' . URL . 'home');
    }
    public function  createTheme($new_theme, $description_theme)
    {
        if ($this->administratorManager->createThemeDB($new_theme, $description_theme)) {
            Tools::alertMessage("Succés de la création du thème", "alert-success");
        } else {
            Tools::alertMessage("Echec de la création du thème", "alert-danger");
        }
        header('Location: ' . URL . 'home');
    }
    // création de l'article avec titre, pitch, url, theme. Le reste sera remplit avec le formulaire update.
    public function createArticle()
    {

        $themes = $this->administratorManager->getAllThemes();
        $data_page = [
            "page_description" => "Page de création d'un article",
            "page_title" => "Page de création d'un article",
            "view" => "./views/pages/admin/createArticle.view.php",
            "texte_1_page" => "Titre, pitch, url et thème sont obligatoires.",
            "texte_2_page" => "On commence par la carte de la page d'accueil.",
            "title_page" => "Crée un nouvel article ! ",
            "themes" => $themes,
            "template" => "views/common/template.php",
        ];
        $this->functions->generatePage($data_page);
    }

    public function validationCreateArticle($title, $theme, $pitch, $url)
    {
        if (!$this->administratorManager->isTitleFree($title)) {
            Tools::alertMessage("Ce titre existe déjà, il faut en trouver un autre !", "alert-warning");
            header('Location: ' . URL . 'administrator/create_article');
            exit();
        }
        if (!$this->administratorManager->isUrlFree($url)) {
            Tools::alertMessage("Cette url existe déjà, il faut en, trouver une autre !", "alert-warning");
            header('Location: ' . URL . 'administrator/create_article');
            exit();
        }
        if ($this->administratorManager->createArticleDB($title, $theme, $pitch, $url)) {
            Tools::alertMessage("Succés de la création de l'article", "alert-success");
        } else {
            Tools::alertMessage("Echec de la création de l'article", "alert-danger");
        }
        header('Location: ' . URL . 'home'); //aller sur l'article quand la fonction existera
    }



    public function  updateArticle()
    {
        $data_page = [
            "page_description" => "Page de modification d'un article",
            "page_title" => "Page de modification d'un article",
            "view" => "./views/pages/admin/updateArticle.view.php",
            "title_page" => "Modification d'un article",
            "template" => "views/common/template.php",
        ];
        $this->functions->generatePage($data_page);
    }

    public function deleteArticle()
    {
    }
}
