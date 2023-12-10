<?php
session_start();


//  on définit la constante URL comme racine du site
define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));

require_once("./controllers/MainController.controller.php");
require_once("./controllers/Tools.php");
$mainController = new MainController();

try {
    if (empty($_GET['page'])) {
        $page = "home";
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }

    switch ($page) {
        case "home":
            $mainController->homePage();
            break;
        case "compte":
            switch ($url[1]) {
                case "profil":
                    $mainController->homePage();
                    break;
            }
            break;
        default:
            throw new Exception("La page n'existe pas");
    }
} catch (Exception $e) {
    $mainController->errorPage($e->getMessage());
}
