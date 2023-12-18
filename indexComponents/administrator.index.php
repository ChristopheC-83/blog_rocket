<?php

// afin de ne pas avoir un index.php à rallonge, 
// ici, la partie administrateur connecté

switch ($url[1]) {
        // page répertoriant les utilisateurs et leurs droits
    case "rights_management":
        $administratorController->rightsManagement();
        break;
        //  modification role des utilisateurs
    case "modify_role":
        $login = Tools::secureHTML($_POST['login']);
        $newRole = Tools::secureHTML($_POST['role']);
        $administratorController->modifyRole($login, $newRole);
        break;
        //  validation/suspension compte des utilisateurs
    case "modify_state":
        $login = Tools::secureHTML($_POST['login']);
        $is_valid = Tools::secureHTML($_POST['is_valid']);
        $administratorController->modifyState($login, $is_valid);
        break;
        //  suppression des utilisateurs
    case "delete_account_user":
        $login = Tools::secureHTML($_POST['login']);
        $administratorController->deleteAccountUser($login);
        break;
        // suppression d'un theme
    case "delete_theme":
        $id_theme = Tools::secureHTML($_POST['id_theme']);
        $editorController->deleteTheme($id_theme);
        break;
        // création d'un theme
    case "create_theme":
        // Tools::showArray($_POST);
        if (!empty($_POST['new_theme']) && !empty($_POST['description_theme'])  && !empty($_POST['color'])) {
            $new_theme = Tools::secureHTML($_POST['new_theme']);
            $description_theme = Tools::secureHTML($_POST['description_theme']);
            $color = Tools::secureHTML($_POST['color']);
            $editorController->createTheme($new_theme, $description_theme, $color);
        } else {
            Tools::alertMessage("Il faut remplir les 2 champs !", "alert-warning");
        }
        break;
        //  creation d'un article titre, pitch, url, theme
    case "create_article":
        $editorController->createArticle();
        break;
        // validation creation d'un article : juste sa carte visible sur l'accueil
    case "validation_creation_article":
        // Tools::showArray($_POST);
        if (!empty($_POST['title']) && !empty($_POST['theme']) && !empty($_POST['pitch']) && !empty($_POST['url'])) {
            $title = Tools::secureHTML($_POST['title']);
            $theme = Tools::secureHTML($_POST['theme']);
            $pitch = Tools::secureHTML($_POST['pitch']);
            $url = Tools::secureHTML($_POST['url']);
            $editorController->validationCreateArticle($title, $theme, $pitch, $url);
        } else {
            Tools::alertMessage("Il faut impérativement remplir les 4 champs !", "alert-warning");
            header('Location: ' . URL . 'administrator/create_article');
        }
        break;
        // on complète un article créé ou on modifie un article existant
    case "update_article":
        if (isset($url[2])) {
            $id_article = Tools::secureHTML($url[2]);
        } else {
            $id_article = $mainManager->getAllArticles()[0]['id_article'];
        }
        $editorController->updateArticle($id_article);
        break;
        // modification du contenu d'une carte d'un article
    case "update_card":
        if (isset($url[2])) {
            $id_article = Tools::secureHTML($url[2]);
            $editorController->updateCard($id_article);
        } else {
            Tools::alertMessage("Il faut choisir un article à modifier !", "alert-warning");
            header('Location: ' . URL . 'administrator/update_article/1');
        }
        break;
        // validation modification d'un article : juste sa carte visible sur l'accueil
    case "validation_update_card":
        if (!empty($_POST['title']) && !empty($_POST['theme']) && !empty($_POST['pitch']) && !empty($_POST['url'])) {
            $id = Tools::secureHTML($_POST['id']);
            $title = Tools::secureHTML($_POST['title']);
            $theme = Tools::secureHTML($_POST['theme']);
            $pitch = Tools::secureHTML($_POST['pitch']);
            $url = Tools::secureHTML($_POST['url']);
            $editorController->validationUpdateArticle($id, $title, $theme, $pitch, $url);
        } else {
            Tools::alertMessage("Il faut impérativement remplir les 4 champs !", "alert-warning");
            header('Location: ' . URL . 'administrator/create_article');
        }
        break;
        //  modif ou creation texte d'un article
    case "update_text_article":
        $id_article = Tools::secureHTML($_POST['id']);
        if (isset($_POST['text']) && !empty($_POST['text'])) {
            $text = Tools::secureHTML($_POST['text']);
            $editorController->updateTextArticle($id_article, $text);
        } else {
            Tools::alertMessage("Il faut remplir le champ TEXTE !", "alert-warning");
        }
        header('Location: ' . URL . 'administrator/update_article/' . $id_article);
        break;
        // ajout d'un media principal à un article
        // principal car on peut ajouter images dans champ texte.
    case "add_media":
        if (isset($url[2]) && !empty($url[2])) {
            $id_article = Tools::secureHTML($_POST['id']);
            switch ($url[2]) {
                    // media principale : une image
                case "image":
                    if (!empty($_FILES['img1']['name'][0])) {
                        $files = $_FILES['img1'];
                        $editorController->addImage($id_article, $files);
                    } else {
                        Tools::alertMessage("Choisissez une image.", "alert-danger");
                    }
                    header('Location: ' . URL . 'administrator/update_article/' . $id_article);
                    break;
                    // media principale : un slider
                case "slider":
                    if (!empty($_FILES['photo']['name'][0])) {
                        $files = $_FILES['photo'];
                        if ($editorController->addSlider($id_article, $files)) {
                            Tools::alertMessage("Ajout du dossier effectué", "alert-success");
                        } else {
                            Tools::alertMessage("Ajout du dossier non effectué", "alert-danger");
                        }
                    } else {
                        Tools::alertMessage("Choisissez au moins une image !", "alert-danger");
                    }
                    header('Location: ' . URL . 'administrator/update_article/' . $id_article);
                    break;
                    // media principale : une video
                case "video":
                    if (!empty($_POST['video'])) {
                        $video_link = ($_POST['video']);
                        $editorController->addVideo($id_article, $video_link);
                    } else {
                        Tools::alertMessage("Choisissez un lien pour une video.", "alert-danger");
                    }
                    header('Location: ' . URL . 'administrator/update_article/' . $id_article);
                    break;
                    // suppression du media principal
                case "erase":
                    $editorController->eraseMedia($id_article);
                    header('Location: ' . URL . 'administrator/update_article/' . $id_article);
                    break;
                default:
                    Tools::alertMessage("Il faut choisir un type de media !", "alert-warning");
                    header('Location: ' . URL . 'administrator/update_article');
            }
        } else {
            Tools::alertMessage("Il faut choisir un type de media !", "alert-warning");
            header('Location: ' . URL . 'administrator/update_article');
        }
        break;
        //  suppression d'un commentaire
    case "delete_comment":
        $editorController->deleteComment($_POST['id_comment']);
        header('Location: ' . URL . 'article/' . $_POST['id_article'] . "/" . $_POST['url']);
        break;
        // suppression d'un article
    case "delete_article":
        $editorController->deleteArticle($_POST['id_article']);
        break;
    default:
        throw new Exception("La page demandée n'existe pas...");
}
