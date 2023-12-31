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
        if (!empty($_POST['new_theme']) && !empty($_POST['description_theme'])) {
            $new_theme = Tools::secureHTML($_POST['new_theme']);
            $description_theme = Tools::secureHTML($_POST['description_theme']);
            $editorController->createTheme($new_theme, $description_theme);
        } else {
            Tools::alertMessage("Il faut remplir les 2 champ !", "alert-warning");
        }
        break;
    case "create_article":
        $editorController->createArticle();
        break;
    case "update_article":
        $editorController->updateArticle();
        break;

    default:
        throw new Exception("La page demandée n'existe pas...");
}
