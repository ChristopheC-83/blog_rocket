<?php

// Classe des possibilités pour un utilisateur connecté

require_once("./controllers/MainController.controller.php");
require_once("./models/User/User.model.php");
require_once("controllers/Tools.php");


class UserController extends MainController
{
    public $userManager;
    public $functions;
    public function __construct()
    {
        $this->functions = new Functions();
        $this->userManager = new UserManager();
    }
    // validation connection
    public function validation_login($login, $password)
    {
        $datasUser = $this->userManager->getUserInfo($login);

        if ($this->userManager->isCombinationValid($login, $password)) {
            // if ($this->userManager->isAccountValidated($login)) {
                Tools::alertMessage("You're welcome !", "alert-success");
                $_SESSION['profile']['login'] = $login;
                $_SESSION['profile']['role'] =  $datasUser['role'];
                $_SESSION['profile']['avatar'] =  $datasUser['avatar'];
                // Tools::generateCookieConnection();
                header('Location: ' . URL . 'account/profile');
            // } else {
            //     Tools::alertMessage("Compte en attente validation", "alert-warning");
            //     $msg = "<a id='resendMailValidation' href='resend_validation_mail/" . $login . "'>=> Renvoyer le mail de validation <=</a> ";
            //     Tools::alertMessage($msg, "alert-warning");
            //     header('Location: ' . URL . 'connection');
            // }
        } else {
            Tools::alertMessage("Combinaison Mot de Passe / Pseudo invalide.", "alert-danger");
            header('Location: ' . URL . 'connection');
        }
    }
    // affichage page de profile
    public function profilePage()
    {
        $datasUser = $this->userManager->getUserInfo($_SESSION['profile']['login']);

        $data_page = [
            "page_description" => "Page de profil",
            "page_title" => "Page de profil",
            "datasUser" => $datasUser,
            // "jsm" => ['profile_modify_mail.js', 'profile_delete_account.js', 'profile_modify_avatar.js'],
            "title_page" => "Profil de " . $_SESSION['profile']['login'] ,
            "view" => "./views/pages/User/profilePage.view.php",
            "template" => "./views/common/template.php",

        ];
        $this->functions->generatePage($data_page);
    }
    // déconnexion de l'utilisateur + desctruction cookie
    public function logout()
    {
        unset($_SESSION['profile']);
        unset($_SESSION['profil']);
       // setcookie(Tools::COOKIE_NAME, '', time() - 3600 * 24 * 365);
        if ($_SESSION['profile']) {
            Tools::alertMessage("La déconnexion a échoué.", "alert-danger");
        } else {
            Tools::alertMessage("Vous êtes bien déconnecté(e).", "alert-success");
        }
        header('Location: ' . URL . 'home');
    }
    // envoi mail validation compte
    // private function sendMailValidation($login, $mail, $account_key)
    // {
    //     $urlValidation = URL . "mail_validation_account/" . $login . "/" . $account_key;
    //     $sujet = "Validez Compte Barpat";
    //     $message = "Validez votre compte sur le blog de Barpat ! Nous t'attendons ! Cliquez sur :" . $urlValidation;
    //     Tools::sendMail($mail, $sujet, $message);
    // }
    // renvoi mail validation compte
    // public function resendValidationMail($login)
    // {

    //     $datasUser = $this->userManager->getUserInfo($login);
    //     $this->sendMailValidation($login, $datasUser['mail'], $datasUser['account_key']);
    //     Tools::alertMessage("Mail de validation renvoyé !", "alert-success");
    //     header('Location: ' . URL . 'connection');
    // }
    // création nouveau compte
    private function registerAccount($login, $password, $mail, $account_key)
    {
        $avatar = "site/astroshiba.jpg";
        if ($this->userManager->registerAccountDB($login, $password, $mail, $account_key, $avatar)) {
            // $this->sendMailValidation($login, $mail, $account_key);
            Tools::alertMessage($login.", votre compte est créé !", "alert-success");
            header('Location: ' . URL . 'home');
        } else {
            Tools::alertMessage("La création a échoué, Réessayez !", "alert-danger");
            header('Location: ' . URL . 'registration');
        }
    }
    // validation création compte
    public function validationRegistration($login, $password, $mail)
    {
        if ($this->userManager->isLoginFree($login)) {
            $password_crypt = password_hash($password, PASSWORD_DEFAULT);
            $account_key = rand(0, 999999);
            $this->registerAccount($login, $password_crypt, $mail, $account_key);
        } else {
            Tools::alertMessage("Pseudo déjà pris. Il faut en choisir un autre !", "alert-warning");
            header('Location: ' . URL . 'registration');
        }
    }
    // compte déjà activé !?!
    private function accountAlreadyActivated($login)
    {
        $datasUser = $this->userManager->getUserInfo($login);
        return ((int)$datasUser['is_valid'] === 1);
    }
    // réponse au clic sur lien de validation envoyé par mail
    public function validationAccountByLinkMail($login, $account_key)
    {
        if ($this->accountAlreadyActivated($login)) {
            $_SESSION['profile']['login'] = $login;
            Tools::alertMessage("Ton compte est déjà activé ! Connecte toi !", "alert-success");
            header('Location: ' . URL . 'home');
        } else {
            if ($this->userManager->validationAccountDB($login, $account_key)) {
                $_SESSION['profile']['login'] = $login;
                Tools::alertMessage("Ton compte est activé ! Connecte toi !", "alert-success");
                header('Location: ' . URL . 'home');
            } else {
                Tools::alertMessage("Echec de l'activation du compte, réessaye.", "alert-danger");
                header('Location: ' . URL . 'registration');
            }
        }
    }
    // modification mail
    public function modifyMail($newMail)
    {
        if ($this->userManager->modifyMailDB($_SESSION['profile']['login'], $newMail)) {
            Tools::alertMessage("Adresse Mail modifiée avec succés.", "alert-success");
        } else {
            Tools::alertMessage("Aucune modification de l'adresse mail.", "alert-danger");
        }
        header('Location: ' . URL . 'account/profile');
    }
    // page modification password
    public function modifyPasswordPage()
    {
        $datasUser = $this->userManager->getUserInfo($_SESSION['profile']['login']);

        $data_page = [
            "page_description" => "Page de profil",
            "page_title" => "Page de profil",
            "datasUser" => $datasUser,
            "js" => ['passwordVerify.js'],
            "view" => "./views/User/modifyPasswordPage.view.php",
            "template" => "./views/templates/template.php",
        ];
        $this->functions->generatePage($data_page);
    }
    // validation modification password
    public function validationNewPassword($old_password, $new_password)
    {
        if ($this->userManager->isCombinationValid($_SESSION['profile']['login'], $old_password)) {
            $password_crypt = password_hash($new_password, PASSWORD_DEFAULT);
            if ($this->userManager->modifyPasswordDB($_SESSION['profile']['login'], $password_crypt)) {
                Tools::alertMessage("Mot de Passe modifié.", "alert-success");
                header('Location: ' . URL . 'account/profile');
            } else {
                Tools::alertMessage("Echec de la modification dun mot de passe.", "alert-danger");
                header('Location: ' . URL . 'account/modify_password');
            }
        } else {
            Tools::alertMessage("Ancien Mot de Passe erroné.", "alert-danger");
            header('Location: ' . URL . 'account/modify_password');
        }
    }
    // envoi nouveau password si oubblié

    public function sendNewPassword($old_password, $new_password, $verif_password)
    {
        if ($old_password === $new_password) {
            Tools::alertMessage("Vous avez remis le même mot de passe ! ", "alert-warning");
            header('Location: ' . URL . 'account/modify_password');
        } else if ($new_password !== $verif_password) {
            Tools::alertMessage("Les nouveaux Mots de Passe ne correspondent pas ! ", "alert-danger");
            header('Location: ' . URL . 'account/modify_password');
        } else {
            $this->validationNewPassword($old_password, $new_password);
        }
    }
    // page mot de passe oublié
    public function forgotPasswordPage()
    {

        $data_page = [
            "page_description" => "mot de passe oublié",
            "page_title" => "mot de passe oublié",
            "jsm" => ['loader.js'],
            "view" => "./views/Visitor/forgotPasswordPage.view.php",
            "template" => "./views/templates/template.php",

        ];
        $this->functions->generatePage($data_page);
    }
    //  validation mail/login avant envoi nouveau mot de passe dans mot de passe oublié
    public function  isCombinationMailValid($login, $mail)
    {
        $maildBd = $this->userManager->getMailUser($login);
        if ($maildBd === $mail) {
            return true;
        } else {
            return false;
        }
    }
    // préparation envoi nouveau mot de passe dans mot de passe oublié
    public function sendNewPasswordAfterForgot($login, $newMdp)
    {
        $mdpCrypte = password_hash($newMdp, PASSWORD_DEFAULT);
        if ($this->userManager->modifyPasswordDB($login, $mdpCrypte)) {
            Tools::alertMessage("Mot de passe provisoire actif", "alert-success");
        } else {
            Tools::alertMessage("Echec de la mise en place du nouveau mot de passe", "alert-danger");
        }
    }
    // envoi mail avec nouveau mot de passe dans mot de passe oublié
    public function sendForgotPassword($login, $mail)
    {

        if (!$this->isCombinationMailValid($login, $mail)) {
            Tools::alertMessage("Pas de concordance, Merci de vérifier", "alert-danger");
            header('Location: ' . URL . 'forgot_password');
        } else {

            echo json_encode(['status' => 'success']);   //pour loader
            $newMdp = $this->functions->generateRandomPassword(20);
            $this->sendNewPasswordAfterForgot($login, $newMdp);
            $destinataire = $mail;
            $sujet = "on a oublié son mdp ?";
            $message = "on va résoudre ça ! \r\nEssaye avec : \r\n \r\n" . $newMdp . " \r\n \r\nChange le sur le site... lui tu ne risques pas de le retenir !";
            Tools::alertMessage("Nouveau mdp envoyé par mail", "alert-success");
            Tools::sendMail($destinataire, $sujet, $message,);
            header('location:' . URL . "connection");
        }
    }
    //  suppression irréversible du compte
    public function deleteAccount()
    {
        $login = $_SESSION['profile']['login'];
        $this->deleteUserAvatar($login);
        rmdir("public/assets/images/avatars/users/" . $login);
        if ($this->userManager->deleteAccountDB($login)) {
            $this->logout();
            Tools::alertMessage("Suppression du compte effectuée. ", "alert-success");
        } else {
            Tools::alertMessage("La suppression du compte a échoué. ", "alert-danger");
            header('Location: ' . URL . 'account/profile');
        }
    }
      // efface l'avatar personnalisé de l'utilisateur s'il en change
      public function deleteUserAvatar($login)
      {
          if ($this->userManager->getImageSiteUser($login) == 0) {
              $oldAvatar = $this->userManager->getImageUser($login);
              unlink("public/assets/images/avatars/" . $oldAvatar);
          }
          return;
      }
      // modifie l'avatar de l'utilisateur
      public function modifyAvatarByPerso($file)
      {
          $this->deleteUserAvatar($_SESSION['profile']['login']);
          try {
              $repertoire = "public/assets/images/avatars/users/"  . $_SESSION['profile']['login'] . "/";
              $nomImage = $this->addImage($file, $repertoire);
              $nomImageBd = "users/" . $_SESSION['profile']['login'] . "/" . $nomImage;
              if ($this->userManager->addImageDB($_SESSION['profile']['login'], $nomImageBd, 0)) {
                  $_SESSION['profile']['avatar'] = $nomImageBd;
                  header('location:' . URL . "account/profile");
              } else {
                  Tools::alertMessage("Modfication de l'image non effectuée.", "rouge");
                  header('location:' . URL . "account/profile");
              }
          } catch (Exception $e) {
              Tools::alertMessage($e->getMessage(), "red");
              header('location:' . URL . "account/profile");
          }
      }
      // ajoute l'avatar personnalisé à la bdd
      public function addImage($file, $repertoire)
      {   // le fichier est il choisi ?
          if (!isset($file['name']) || empty($file['name'])) {
              throw new Exception("Vous devez sélectionner une image.");
          }
          //le dossier de recption existe il ? si non création.
          if (!file_exists($repertoire)) mkdir($repertoire, 0777, true);
          $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
          $random = rand(0, 999999);
          $target_file = $repertoire . "/" . $random . "_" . $file['name'];
          // test du fichier proposé
          if (!getimagesize($file["tmp_name"]))
              throw new Exception("Le fichier n'est pas une image");
          if ($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
              throw new Exception("L'extension du fichier n'est pas reconnue");
          if (file_exists($target_file))
              throw new Exception("Le fichier existe déjà.");
          if ($file['size'] > 500000)
              throw new Exception("Le fichier est trop volumineux (500ko maximum).");
          if (!move_uploaded_file($file['tmp_name'], $target_file))
              throw new Exception("L'ajout de l'image n'a pas fonctionné");
          else return ($random . "_" . $file['name']);
      }
      // modification de l'avatar par un générique du site
      public function modifyAvatarBySite($avatar)
      {
          $this->deleteUserAvatar($_SESSION['profile']['login']);
          $linkAvatar = "site/" . $avatar;
          if ($this->userManager->ModifyAvatarDB($_SESSION['profile']['login'], $linkAvatar, 1)) {
              $_SESSION['profile']['avatar'] = $linkAvatar;
              header('location:' . URL . "account/profile");
          } else {
              Tools::alertMessage("Modification de l'image non effectuée.", "red");
              header('location:' . URL . "account/profile");
          }
      }
}
