<?php

// Classe des pages/fonctions propres à l'utilisateur non connecté (ou en cours de connection/inscription) 

require_once("./controllers/MainController.controller.php");
require_once("./models/visitor/Visitor.model.php");
require_once("controllers/Tools.php");
require_once("controllers/Functions.php");

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
        // infos injectées dans la page
        $mainManager = new MainManager();
        $themes = $this->visitorManager->getAllThemes();
        $articles = $this->visitorManager->getAllArticles();
        // éléments constitutifs de la pages
        $data_page = [
            // infos récupérer dans le template pour information du navigateur
            "page_description" => "Description de la page d'accueil",
            "page_title" => "BARPAT | accueil",
            // fichier(s) JS utlisé()s, récupération dans le fichier template
            "javascript" => ['home_page_animated_grid.js'],
            // infos récupérées et injectées dans la page
            "themes" => $themes,
            "articles" => $articles,
            "mainManager" => $mainManager,
            // ces 3 lignes sont à personnaliser pour chaque page , affichage dans le header
            "texte_1_page" => "Autour du code",
            "texte_2_page" => "Partageons, échangeons !",
            "title_page" => "Seul on va plus vite, ensemble on va plus loin !",
            // fichier de la vue
            "view" => "views/pages/visitor/homePage.view.php",
            // fichier du template
            "template" => "./views/common/template.php"
        ];
        // cette fonction recompose la vue avec toutes les infos données ci-dessus
        $this->functions->generatePage($data_page);
    }

    //  page avec les articles pour un theme choisi.
    public function themePage($theme)
    {
        $istheme = $this->visitorManager->getColorTheme($theme);
        $articles = $this->visitorManager->getArticlesByThemes($theme);
        $choosenTheme = $this->visitorManager->getChoosenTheme($theme);
        // Si pas de couleur détectée, le theme n'existe pas.
        if (!isset($istheme['color'])) {
            $this->errorPage("Ce thème n'existe pas.");
            exit();
        }
        // Si couleur détectée mais pas encore d'article, on le précise.
        if (empty($articles)) {
            Tools::alertMessage("Pas encore d'article sur ce thème. Ca va arriver 😉.", "alert-warning");
        }
        // si articles, on affiche leur carte.
        $mainManager = new MainManager();
        $themes = $this->visitorManager->getAllThemes();
        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "BARPAT | " . $choosenTheme['theme'],
            "javascript" => ['home_page_animated_grid.js'],
            "choosenTheme" => $choosenTheme,
            "themes" => $themes,
            "articles" => $articles,
            "mainManager" => $mainManager,
            "texte_1_page" => ucfirst($choosenTheme['theme']),
            "texte_2_page" => "_______________________________",
            "title_page" =>  $choosenTheme['description_theme'],
            "view" => "views/pages/visitor/homePage.view.php",
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
        $commentaires = $this->visitorManager->getCommentsByArticle($id_article);
        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "BARPAT | " . $article['title'],
            "view" => "views/pages/visitor/articlePage.view.php",
            "article" => $article,
            "texte_1_page" => "Catégorie : " . $article['theme'],
            "texte_2_page" => "_________________________",
            "title_page" => $article['title'],
            "commentaires" => $commentaires,
            "template" => "./views/common/template.php"
        ];
        $this->functions->generatePage($data_page);
    }
    // création compte
    public function registrationPage()
    {
        $data_page = [
            "page_description" => "Page de création de compte",
            "page_title" => "BARPAT | création de compte",
            "texte_1_page" => "Nous n'attendions que toi !",
            "texte_2_page" => "Installe toi à ton aise 😉 ",
            "title_page" => "Création de ton compte.",
            "view" => "views/pages/visitor/registrationPage.view.php",
            "template" => "views/common/template.php",
        ];
        $this->functions->generatePage($data_page);
    }
    // page de connexion
    public function connectionPage()
    {
        $data_page = [
            "page_description" => "Page de connexion",
            "page_title" => "BARPAT | connexion",
            "javascript" => ['loader.js'],
            "texte_1_page" => "Et si tu n'es pas inscrit(e),",
            "texte_2_page" => " ⏬ C'est par là aussi ! ⏬ ",
            "title_page" => "Connexion",
            "view" => "views/pages/visitor/connectionPage.view.php",
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

     //api de tous les articles
     public function sendApiArticles()
     {
        $articles = $this->visitorManager->getAllArticles();
         echo json_encode($articles);
     }
}
