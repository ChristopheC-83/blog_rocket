<?php

// Classe des possibilités pour un utilisateur connecté en tant qu'administrateur

require_once("./controllers/Functions.php");
require_once("./models/admin/Administrator.model.php");
require_once("./controllers/MainController.controller.php");
require_once("./controllers/user/User.controller.php");
// require_once("./controllers/Images.controller.php");

class AdminstratorController extends MainController
{
    public $functions;
    public $administratorManager;
    public $userController;
    // public $imageController;
    public function __construct()
    {
        $this->functions = new Functions();
        $this->administratorManager = new AdministratorManager();
        //  appel à userManager nécessaire pour utiliser une méthode pour la suppression d'un compte
        $this->userController = new UserController();
    }
    // page des utilisateurs et paramétrage
    public function rightsManagement()
    {
        $infoUsers = $this->administratorManager->getUsers();
        $data_page = [
            "page_description" => "Page de gestion des droits",
            "page_title" => "BARPAT | gestion des droits",
            "view" => "./views/pages/admin/rightsManagement.view.php",
            "texte_1_page" => "Dans l'antre des Dieux !",
            "texte_2_page" => "Pas de bêtises hein !?!",
            "title_page" => "Gestion des droits",
            "javascript" => ['rights_management.js'],
            "infoUsers" => $infoUsers,
            "template" => "views/common/template.php",
        ];
        $this->functions->generatePage($data_page);
    }
    //  modifier le role d'un utilisateur inscrit
    public function modifyRole($login, $newRole)
    {
        if ($this->administratorManager->modifyRoleDB($login, $newRole)) {
            Tools::alertMessage("Succés de la modification du rôle", "alert-success");
        } else {
            Tools::alertMessage("Echec de la modification du rôle", "alert-danger");
        }
        header('Location: ' . URL . 'administrator/rights_management');
    }
    //  modifier le statut d'un utilisatuer inscrit (valider son compte)
    public function modifyState($login, $is_valid)
    {
        if ($this->administratorManager->modifyStateDB($login, $is_valid)) {
            Tools::alertMessage("Succés de la modification de l'état.", "alert-success");
        } else {
            Tools::alertMessage("Echec de la modification de l'état.", "alert-danger");
        }
        header('Location: ' . URL . 'administrator/rights_management');
    }
    // supprimer le dossier image d'un utilisateur si suppression de son compte
    public function deleteDirectory($dir)
    {
        if (!is_dir($dir)) {
            return false;
        }
        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            if (is_dir($path)) {
                $this->deleteDirectory($path); // Appel récursif pour les sous-répertoires, pas utilisé ici
            } else {
                unlink($path); // Suppression des fichiers
            }
        }
        return rmdir($dir); // Suppression du répertoire principal de l'utilisateur
    }
    //  suppression compte utilisateur
    public function deleteAccountUser($login)
    {
        $this->userController->deleteUserAvatar($login);
        rmdir("public/assets/images/avatars/users/" . $login);
        if ($this->administratorManager->deleteAccountDB($login)) {
            Tools::alertMessage("Suppression compte effectuée", "alert-success");
        } else {
            Tools::alertMessage("Echec de la suppression du compte.", "alert-danger");
        }
        header('Location: ' . URL . 'administrator/rights_management');
    }
    

}
