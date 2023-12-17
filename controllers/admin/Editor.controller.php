<?php

// Classe des possibilités pour un utilisateur connecté en tant qu'administrateur

require_once("./controllers/Functions.php");
require_once("./controllers/Images.php");
require_once("./models/Admin/Administrator.model.php");
require_once("./controllers/MainController.controller.php");
require_once("./controllers/user/User.controller.php");
require_once("./controllers/Tools.php");
// require_once("./controllers/Images.controller.php");

class EditorController extends MainController
{
    public $functions;
    public $images;
    public $administratorManager;
    // public $imageController;
    public function __construct()
    {
        $this->functions = new Functions();
        $this->images = new Images();
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
    public function  createTheme($new_theme, $description_theme, $color)
    {
        if ($this->administratorManager->createThemeDB($new_theme, $description_theme, $color)) {
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

            "javascript" => ['new_article.js'],
            "themes" => $themes,
            "template" => "views/common/template.php",
        ];
        $this->functions->generatePage($data_page);
    }
    public function updateCard($id)
    {

        $article = $this->administratorManager->getOneArticle($id);
        $themes = $this->administratorManager->getAllThemes();
        $data_page = [
            "page_description" => "Page de création d'un article",
            "page_title" => "Page de création d'un article",
            "view" => "./views/pages/admin/updateCard.view.php",
            "texte_1_page" => "Titre, pitch, url et thème sont toujours obligatoires.",
            "texte_2_page" => "On modifie la carte de la page d'accueil.",
            "title_page" => "Mettons à jour cette carte ! ",
            "javascript" => ['new_article.js'],
            "article" => $article,
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



    public function updateArticle($id)
    {
        $oneArticle = $this->administratorManager->getOneArticle($id);
        $articles = $this->administratorManager->getAllArticles();
        $themes = $this->administratorManager->getAllThemes();
        $data_page = [
            "page_description" => "Page de création d'un article",
            "page_title" => "Page de création d'un article",
            "view" => "./views/pages/admin/updateArticle.view.php",
            "texte_1_page" => "Pour finaliser la création de l'article,",
            "texte_2_page" => "Ou compléter un nouveau.",
            "title_page" => "Vas-y ! Exprime toi !",
            "javascript" => ['tiny.js', 'update_article.js'],
            "articles" => $articles,
            "oneArticle" => $oneArticle,
            "themes" => $themes,
            "template" => "views/common/templateUpdateArticle.php",
        ];
        $this->functions->generatePage($data_page);
    }
    public function validationUpdateArticle($id, $title, $theme, $pitch, $url)
    {
        $oneArticle = $this->administratorManager->getOneArticle($id);

        if ($title !== $oneArticle['title'] && !$this->administratorManager->isTitleFree($title)) {
            Tools::alertMessage("Ce titre existe déjà, il faut en trouver un autre !", "alert-warning");
            header('Location: ' . URL . 'administrator/update_article');
            exit();
        }
        if ($url !== $oneArticle['url'] && !$this->administratorManager->isUrlFree($url)) {
            Tools::alertMessage("Cette url existe déjà, il faut en, trouver une autre !", "alert-warning");
            header('Location: ' . URL . 'administrator/update_article');
            exit();
        }
        if ($this->administratorManager->updateArticleDB($id, $title, $theme, $pitch, $url)) {
            Tools::alertMessage("Succés de la modification de l'article", "alert-success");
        } else {
            Tools::alertMessage("Echec de la modification de l'article", "alert-danger");
        }
        header('Location: ' . URL . 'administrator/update_article/' . $id);
    }

    // gestion des medias

    // ajouter une image à un article
    public function addImage($id_article, $files)
    {
        // Tools::showArray($files);
        // Tools::showArray($id_article);

        // ajout de l'image dans les dossiers
        $this->images->add_image($id_article, $files);
        // ajout de l'image en bdd
        $this->administratorManager->addImage1ArticleDB($id_article,  $files['name']);
    }
    // ajouter un slider à un article
    public function addSlider($id_article, $files)
    {
        // vidage dossier de l'article
        $this->images->eraseFolderContent($id_article);
        // vidage img1 / slider / video en bdd
        $this->administratorManager->eraseMedia($id_article);
        // // ajout de l'image dans les dossiers
        $this->images->add_slider($id_article, $files);
        // // ajout de l'image en bdd
        $this->administratorManager->addSliderArticleDB($id_article, "article_" . $id_article);
    }
    // ajouter une video à un article
    public function addVideo($id_article, $video_link)
    {
        // vidage dossier de l'article
        $this->images->eraseFolderContent($id_article);
        // vidage img1 / slider / video en bdd
        $this->administratorManager->eraseMedia($id_article);
        // // ajout de l'image en bdd
        $this->administratorManager->addVideoArticleDB($id_article, $video_link);
    }
    // suppression des medias d'un article

    public function eraseMedia($id_article)
    {
        // vidage dossier de l'article
        $this->images->eraseFolderContent($id_article);
        // vidage img1 / slider / video en bdd
        $this->administratorManager->eraseMedia($id_article);
        //suppression du dossier des média de l'article
        rmdir(MEDIA_PATH . $id_article);
    }

    // gestion du texte d'un article
    public function updateTextArticle($id_article, $text)
    {

        if ($this->administratorManager->updateTextArticleDB($id_article, $text)) {
            Tools::alertMessage("Succés de la modification du texte de l'article", "alert-success");
        } else {
            Tools::alertMessage("Echec de la modification du texte de l'article", "alert-danger");
        }
    }

    //effacer un commentaire
    public function  deleteComment($id_comment){ 
        if ($this->administratorManager->deleteCommentDB($id_comment)) {
            Tools::alertMessage("Succés de la suppression du commentaire", "alert-success");
        } else {
            Tools::alertMessage("Echec de la suppression du commentaire", "alert-danger");
        }
        // header('Location: ' . URL . 'administrator/update_article/' . $id_comment);
    }



    public function deleteArticle()
    {
    }
}
