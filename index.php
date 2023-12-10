<?php

// Tous els chemins passent par ce point : "index.php"

// on démarre une SESSION
// A la connexion, l'utilisateur y stockera son login, role, avatar pour validation et utilisation ultérieure

session_start();


//  on définit la constante URL comme racine du site
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));

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
            $visitorController->connectionPage();
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















            break;
        default:
            throw new Exception("La page n'existe pas");
    }
} catch (Exception $e) {
    $visitorController->errorPage($e->getMessage());
}
