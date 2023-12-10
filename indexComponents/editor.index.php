<?php

switch ($url[1]) {
        // Page de création d'un article
    case "create_card_article":
        $editorController->createCardArticle();
        break;

    case "validation_creation_card_article":
        // Tools::showArray($_POST);
        $title = Tools::secureHTML($_POST['title']);
        $pitch = Tools::secureHTML($_POST['pitch']);
        $theme = Tools::secureHTML($_POST['theme']);
        $url = Tools::secureHTML($_POST['url']);
        $editorController->validationCreateCardArticle($title, $pitch, $theme, $url);
        break;



    case "create_text_article":
        // // Tools::showArray($_POST);
        // if (isset($_POST['chooseArticle'])) {
        //     $id_article = Tools::secureHTML($_POST['chooseArticle']);
        // } else
         if (isset($url[2])) {
            $id_article = Tools::secureHTML($url[2]);
        } else {
            $id_article = 1;
        }
        $editorController->createTextArticle($id_article);
        break;
    case "modify_card":
        $id_article = Tools::secureHTML($url[2]);
        $editorController->modifyCard($id_article);
        break;

        
    case "modify_card_article":
        $id_article = Tools::secureHTML($_POST['id_article']);
        $title = Tools::secureHTML($_POST['title']);
        $pitch = Tools::secureHTML($_POST['pitch']);
        $theme = Tools::secureHTML($_POST['theme']);
        $url = Tools::secureHTML($_POST['url']);
        $editorController->validationModificationCardArticle($id_article, $title, $pitch, $theme, $url);
        break;

    case "validate_text_article":
        Tools::showArray($_POST);
        $id_article = Tools::secureHTML($_POST['id_article']);
        $titre1 = Tools::secureHTML($_POST['titre1']);
        $texte1 = Tools::secureHTML($_POST['texte1']);
        $titre2 = Tools::secureHTML($_POST['titre2']);
        $texte2 = Tools::secureHTML($_POST['texte2']);
        $editorController->validationTextArticle($id_article, $titre1, $texte1, $titre2, $texte2);
        break;











    case "modify_article":
        $editorController->modifyArticle();
        break;
    case "delete_article":
        $editorController->deleteArticle();
        break;

    default:
        throw new Exception("La page demandée n'existe pas...");
}