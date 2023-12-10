<?php

// Classe des possibilités pour un utilisateur connecté en tant qu'administrateur

require_once("./controllers/Functions.controller.php");
require_once("./models/Admin/Administrator.model.php");
require_once("./controllers/Main.controller.php");
require_once("./models/User/User.model.php");
// require_once("./controllers/Images.controller.php");

class AdminstratorController extends MainController
{
    public $functions;
    public $administratorManager;
    public $userManager;
    // public $imageController;
    public function __construct()
    {
        $this->functions = new Functions();
        $this->administratorManager = new AdministratorManager();
        //  appel à userManager nécessaire pour utiilser une méthode pour la suppression d'un compte
        $this->userManager = new UserManager();
    }
    // page des utilisateurs et paramétrage
    public function rightsManagement()
    {
        $infoUsers = $this->administratorManager->getUsers();
        $data_page = [
            "page_description" => "Page de gestion des droits",
            "page_title" => "Page de gestion des droits",
            "view" => "./views/Admin/rightsManagement.view.php",
            "js" => ['rights_management.js'],
            "infoUsers" => $infoUsers,
            "template" => "views/templates/template.php",
        ];
        $this->functions->generatePage($data_page);
    }
    //  modifier le role d'un utilisateur inscrit
    public function modifyRole($login, $newRole)
    {
        if ($this->administratorManager->modifyRoleDB($login, $newRole)) {
            Tools::alertMessage("Succés de la modification du rôle", "green");
        } else {
            Tools::alertMessage("Echec de la modification du rôle", "red");
        }
        header('Location: ' . URL . 'administrator/rights_management');
    }
    //  modifier le statut d'un utlistauer inscrit (valider son compte)
    public function modifyState($login, $is_valid)
    {
        if ($this->administratorManager->modifyStateDB($login, $is_valid)) {
            Tools::alertMessage("Succés de la modification de l'état.", "green");
        } else {
            Tools::alertMessage("Echec de la modification de l'état.", "red");
        }
        header('Location: ' . URL . 'administrator/rights_management');
    }
    // supprimer le dossier image d'un utilisateur si suppression de son compte
    private function deleteDirectory($dir)
    {
        if (!is_dir($dir)) {
            return false;
        }
        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (is_dir($path)) {
                $this->deleteDirectory($path); // Appel récursif pour les sous-répertoires
            } else {
                unlink($path); // Suppression des fichiers
            }
        }
        return rmdir($dir); // Suppression du répertoire principal
    }
    //  suppression compte utilisateur
    public function deleteAccountUser($login)
    {
        // $this->deleteDirectory("public/assets/images/avatars/users/" . $login);
        $this->deleteUserAvatar($login);
        rmdir("public/assets/images/avatars/users/" . $login);
        if ($this->administratorManager->deleteAccountDB($login)) {
            Tools::alertMessage("Suppression compte effectuée", "green");
        } else {
            Tools::alertMessage("Echec de la suppression du compte.", "red");
        }
        header('Location: ' . URL . 'administrator/rights_management');
    }
}
