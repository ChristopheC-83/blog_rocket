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

        $mainManager = new MainManager();
        $themes = $this->visitorManager->getAllThemes();
        $articles = $this->visitorManager->getAllArticles();
        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Titre de la page d'accueil",
            "view" => "views/pages/visitor/homePage.view.php",
            "javascript" => ['home_page_animated_grid.js'],
            "themes" => $themes,
            "articles" => $articles,
            "mainManager" => $mainManager,
            "texte_1_page" => "Autour du code",
            "texte_2_page" => "Partageons, échangeons !",
            "title_page" => "Seul on va plus vite, ensemble on va plus loin !",
            "template" => "./views/common/template.php"
        ];
        $this->functions->generatePage($data_page);
    }
    // page d'affichge d'un article

    public function articlePage($id_article, $url)
    {
        $article = $this->visitorManager->getOneArticle($id_article);
        // Si pas d'article, on le précise.
        if (empty($article)) {
            Tools::alertMessage("Cet article n'existe pas... ou pas encore !", "alert-warning");
            header('Location: ' . URL . 'home');
            exit();
        }
        // Si url ne correspond pas à l'url de l'id de l'article, on rejette.
        if ($article['url'] != $url) {
            Tools::alertMessage("Problème dans l'url de l'article, réessayez.", "alert-warning");
            header('Location: ' . URL . 'home');
            exit();
        }
        //  si pas de texte, article inaccessible.
        if (empty($article['text'])) {
            Tools::alertMessage("Article en cours de rédaction, merci de patienter.", "alert-warning");
            header('Location: ' . URL . 'home');
            exit();
        }
        // si article, on affiche sa carte.
        // $mainManager = new MainManager();
        // $themes = $this->visitorManager->getAllThemes();
        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Titre de la page d'accueil",
            "view" => "views/pages/visitor/articlePage.view.php",
            "javascript" => ['home_page_animated_grid.js'],
            "article" => $article,
            // "themes" => $themes,
            // "mainManager" => $mainManager,
            "texte_1_page" => "Catégorie : " . $article['theme'],
            "texte_2_page" => "_________________________",
            "title_page" => $article['title'],
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



    //  page avec les articles pour un theme choisi.
    public function themePage($theme)
    {
        $istheme = $this->visitorManager->getColorTheme($theme);
        $articles = $this->visitorManager->getArticlesByThemes($theme);

        // Si pas de couleur détectée, le theme n'existe pas.
        if (!isset($istheme['color'])) {
            $this->errorPage("Ce thème n'existe pas.");
            exit();
        }
        // Si couleur détectée mais pas d'article, on le précise.
        if (empty($articles)) {
            $this->errorPage("Pas encore d'article sur ce thème. Ca va arriver 😉.");
            exit();
        }
        // si articles, on affiches leurs cartes.
        $mainManager = new MainManager();
        $themes = $this->visitorManager->getAllThemes();
        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Titre de la page d'accueil",
            "view" => "views/pages/visitor/homePage.view.php",
            "javascript" => ['home_page_animated_grid.js'],
            "themes" => $themes,
            "articles" => $articles,
            "mainManager" => $mainManager,
            "texte_1_page" => "Autour du code",
            "texte_2_page" => "Partageons, échangeons !",
            "title_page" => "Seul on va plus vite, ensemble on va plus loin !",
            "template" => "./views/common/template.php"
        ];
        $this->functions->generatePage($data_page);
    }


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
