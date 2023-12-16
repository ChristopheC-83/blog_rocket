<?php

switch ($url[1]) {
        // page répertoriant les utilisateur
    case "rights_management":
        $administratorController->rightsManagement();
        break;
        //  modification role des utilisateurs
    case "modify_role":
        $login = Tools::secureHTML($_POST['login']);
        $newRole = Tools::secureHTML($_POST['role']);
        $administratorController->modifyRole($login, $newRole);
        break;
        //  validation compte des utilisateurs
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

        // on complète un articler créé ou on modifie un article existant
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
        // Tools::showArray($_POST);
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
        Tools::showArray($_POST);
        // $editorController->deleteArticle();
        break;

    case "add_media":
        // Tools::showArray($_FILES);
        // Tools::showArray($_POST);

        if (isset($url[2]) && !empty($url[2])) {
            $id_article = Tools::secureHTML($_POST['id']);


            switch ($url[2]) {
                case "image":
                    if (!empty($_FILES['img1']['name'][0])) {
                        $files = $_FILES['img1'];
                        if ($editorController->addImage($id_article, $files)) {
                            Tools::alertMessage("Ajout de l'image effectué", "alert-success");
                        } else {
                            Tools::alertMessage("Ajout de l'image échoué", "alert-danger");
                        }
                    }else {
                        Tools::alertMessage("Choisissez une image.", "alert-danger");
                    }
                    header('Location: ' . URL . 'administrator/update_article/' . $id_article);
                    break;
                case "slider":
                    // Tools::showArray($_FILES['photo']);
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

                    // case "video":
                    //     $editorController->addVideo($id_article, $files);
                    //     break;
                default:
                    Tools::alertMessage("Il faut choisir un type de media !", "alert-warning");
                    header('Location: ' . URL . 'administrator/update_article');
            }
        } else {

            Tools::alertMessage("Il faut choisir un type de media !", "alert-warning");
            header('Location: ' . URL . 'administrator/update_article');
        }

        // header('Location: ' . URL . 'administrator/update_article');
        break;












        //  suppression d'un article
    case "delete_article":
        $editorController->deleteArticle();
        break;


    default:
        throw new Exception("La page demandée n'existe pas...");
}
