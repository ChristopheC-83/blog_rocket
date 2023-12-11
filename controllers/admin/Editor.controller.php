<?php

// Classe des possibilités pour un utilisateur connecté en tant qu'administrateur

require_once("./controllers/Functions.php");
require_once("./models/Admin/Administrator.model.php");
require_once("./controllers/MainController.controller.php");
require_once("./controllers/user/User.controller.php");
// require_once("./controllers/Images.controller.php");

class EditorController extends MainController
{
    public $functions;
    public $administratorManager;
    // public $imageController;
    public function __construct()
    {
        $this->functions = new Functions();
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
    public function  createTheme($new_theme, $description_theme)
    {
        if ($this->administratorManager->createThemeDB($new_theme, $description_theme)) {
            Tools::alertMessage("Succés de la création du thème", "alert-success");
        } else {
            Tools::alertMessage("Echec de la création du thème", "alert-danger");
        }
        header('Location: ' . URL . 'home');
    }
}
