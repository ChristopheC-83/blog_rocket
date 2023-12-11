<?php

// Tous els chemins passent par ce point : "index.php"

// on démarre une SESSION
// A la connexion, l'utilisateur y stockera son login, role, avatar pour validation et utilisation ultérieure

session_start();


//  on définit la constante URL comme racine du site
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));
define("IMG_PATH", URL . "public/assets/images/");
define("AVATARS_PATH", IMG_PATH . "avatars/");

require_once("./controllers/visitor/Visitor.controller.php");
require_once("./controllers/user/User.controller.php");
require_once("./controllers/Tools.php");
$visitorController = new VisitorController();
$userController = new UserController();



try {
    if (empty($_GET['page'])) {
        $page = "home";
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }

    switch ($page) {
        case "home":
            $visitorController->homePage();
            break;
        case "compte":
            switch ($url[1]) {
                case "profil":
                    $visitorController->homePage();
                    break;
            }
            // page de connection à son compte d'un utilisateur
        case "connection":
            if (Tools::isConnected()) {

                Tools::alertMessage("Vous êtes déjà connecté !", "alert-warning");
                header('Location: ' . URL . 'home');
            } else {

                $visitorController->connectionPage();
            }
            break;
            // confirmation de la concordance login / mdp pour sécuriser la connexion
        case "validation_login":
            // Tools::showArray($_POST);
            if (!empty($_POST['login']) && !empty($_POST['password'])) {
                $login = Tools::secureHTML($_POST['login']);
                $password = Tools::secureHTML($_POST['password']);
                $userController->validation_login($login, $password);
            } else {
                Tools::alertMessage("Il faut remplir les 2 champs !", "alert-warning");
                header('Location: ' . URL . 'connection');
            }
            break;
        case "registration":
            $visitorController->registrationPage();
            break;
            // validation de l'enregistrement d'un nouveau compte
        case "validation_registration":
            if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['mail'])) {
                $login = Tools::secureHTML($_POST['login']);
                $password = Tools::secureHTML($_POST['password']);
                $mail = Tools::secureHTML($_POST['mail']);
                $userController->validationRegistration($login, $password, $mail);
            } else {
                Tools::alertMessage("Il faut remplir les 3 champs !", "alert-warning");
                header('Location: ' . URL . 'registration');
            }
            break;
            // envoi d'un mail pour valider le nouveau compte
        // case "mail_validation_account":
        //     $login = Tools::secureHTML($url[1]);
        //     $account_key = Tools::secureHTML($url[2]);
        //     $userController->validationAccountByLinkMail($login, $account_key);
        //     break;
        //     // renvoi d'un mail pour valider le nouveau compte
        // case "resend_validation_mail":
        //     $login = Tools::secureHTML($url[1]);
        //     $userController->resendValidationMail($login);
        //     break;
            // page pour demande d'un mail avec nouveau mot de passe
        case "forgot_password":
            $userController->forgotPasswordPage();
            break;
            // envoi d'un mail avec nouveau mot de passe
        case "send_forgot_password":
            if (!empty($_POST['login']) && !empty($_POST['mail'])) {
                $login = Tools::secureHTML($_POST['login']);
                $mail = Tools::secureHTML($_POST['mail']);
                $userController->sendForgotPassword($login, $mail);
            } else {
                Tools::alertMessage('Login ou mail non renseigné.', 'alert-danger');
                header('location:' . URL . "forgot_password");
                exit;
            }
            break;




            // si l'utilisateur est connecté en tant qu'utilisateur ou plus :
            // les accés sont dans le fichier indexComponents/user.index.php
        case "account":
            if (!Tools::isConnected()) {
                Tools::alertMessage("Vous devez vous connecter pour accéder à cet espace.", "alert-danger");
                header('Location: ' . URL . 'connection');
                // } elseif (!Tools::checkCookieConnection()) {
                //     Tools::badCookie();
            } else {
                require_once("./indexComponents/user.index.php");
            }
            break;













        default:
            throw new Exception("La page n'existe pas");
    }
} catch (Exception $e) {
    $visitorController->errorPage($e->getMessage());
}