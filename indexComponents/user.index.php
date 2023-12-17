<?php


switch ($url[1]) {
        //  accés à la page de profil
    case "profile":
        $userController->profilePage();
        break;
        // déconnexion
    case "logout":
        $userController->logout();
        break;
        //  modification du mail de l'utilisateur
    case "modify_mail":
        $newMail = Tools::secureHTML($_POST['new_mail']);
        $userController->modifyMail($newMail);
        break;
        // validation modification du mot de passe de l'utilisateur
    case "modify_password":
        if (!empty($_POST['password']) && !empty($_POST['new_password']) && !empty($_POST['verif_password'])) {
            $old_password = Tools::secureHTML($_POST["password"]);
            $new_password = Tools::secureHTML($_POST["new_password"]);
            $verif_password = Tools::secureHTML($_POST["verif_password"]);
            $userController->sendNewPassword($old_password, $new_password, $verif_password);
        } else {
            Tools::alertMessage("Il faut remplir les 3 champs !", "alert-warning");
            header('Location: ' . URL . 'account/modify_password');
        }
        break;
        //  modification de l'avatar par un avatar générique du site
    case "modify_avatar_by_site":
        $newAvatar = Tools::secureHTML($_POST['avatar']);
        $userController->modifyAvatarBySite($newAvatar);
        break;
        //  modification de l'avatar par un avatar personnel de l'utilisateur
    case "modify_image_by_perso":
        if ($_FILES['image']['size'] > 0) {
            $userController->modifyAvatarByPerso($_FILES['image']);
        } else {
            Tools::alertMessage("Image non modifiée", "alert-danger");
            header('location:' . URL . "profil");
        }
        break;
        //  suppression irréversible du compte de l'utilisateur
    case "delete_account":
        $userController->deleteAccount();
        break;

    case 'post_comment':
        $id_article = Tools::secureHTML($_POST['id_article']);
        $author = Tools::secureHTML($_POST['author']);
        $url = Tools::secureHTML($_POST['url']);

        if (isset($_POST['text']) && !empty($_POST['text'])) {
            $text = Tools::secureHTML($_POST['text']);
            $userController->postComment($id_article, $author,$text, $url );
        } else {
            Tools::alertMessage("Avec du texte, c'est mieux !", "alert-warning");
            header('Location: ' . URL . 'article/' . $id_article . '/' . $url);
        }
        break;
    default:
        throw new Exception("La page demandée n'existe pas...");
}
