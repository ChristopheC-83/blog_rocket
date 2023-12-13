<?php

// Tous les chemins passent par ce point : "index.php"

// on démarre une SESSION
// A la connexion, l'utilisateur y stockera son login, role, avatar pour validation et utilisations ultérieures

session_start();


//  on définit la constante URL comme racine du site
// des constantes pour les chemins des images, avatars, sliders, videos...
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));
define("IMG_PATH", URL . "public/assets/images/");
define("AVATARS_PATH", IMG_PATH . "avatars/");


require_once("./controllers/visitor/Visitor.controller.php");
require_once("./controllers/user/User.controller.php");
require_once("./controllers/admin/Administrator.controller.php");
require_once("./controllers/admin/Editor.controller.php");
require_once("./controllers/Tools.php");
$visitorController = new VisitorController();
$userController = new UserController();
$administratorController = new AdminstratorController();
$editorController = new EditorController();



try {
    // si pas de page demandée, on affiche la page d'accueil
    if (empty($_GET['page'])) {
        $page = "home";
    } else {
        //  on "explose" l'url pour récupérer la page demandée
        // peut se décomposer en $url[0]/$url[1]/...
        //pratique en cas de formulaire GET ! 
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }

    // 1ere partie, les pages accessibles à tous les visiteurs
    switch ($page) {
        case "home":
            $visitorController->homePage();
            break;
        case "compte":
            switch ($url[1]) {
                case "profil":
                    $visitorController->homePage();
            }
            break;

            // page d'enregistrement d'un nouveau compte
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

            // on empêche un utilisateur connecté de retourner sur la page de connexion
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

        case "theme":
            if (!empty($url[1])) {
                $theme = Tools::secureHTML($url[1]);
                $visitorController->themePage($theme);
            } else {
                Tools::alertMessage("Il faut choisir un thème !", "alert-warning");
                header('Location: ' . URL . 'home');
            }


            // si l'utilisateur est connecté en tant qu'utilisateur ou plus :
            // les accés sont dans le fichier indexComponents/user.index.php
        case "account":
            if (!Tools::isConnected()) {
                Tools::alertMessage("Vous devez vous connecter pour accéder à cet espace.", "alert-danger");
                header('Location: ' . URL . 'connection');
            } else {
                require_once("./indexComponents/user.index.php");
            }
            break;

            // si l'utilisateur est connecté et a un statut d'administrateur :
        case "administrator":
            if (!Tools::isConnected()) {
                Tools::alertMessage("Vous devez vous connecter pour accéder à cet espace.", "alert-danger");
                header('Location: ' . URL . 'connection');
            } elseif (!Tools::isAdministrator()) {
                Tools::alertMessage("Vous n'avez pas le statut requis.", "alert-danger");
                header('Location: ' . URL . 'account/profile');
            } else {
                require_once("./indexComponents/administrator.index.php");
            }
            break;
        default:
            throw new Exception("La page n'existe pas");
    }
} catch (Exception $e) {
    $visitorController->errorPage($e->getMessage());
}
