<?php


require_once("./models/MainManager.model.php");

class UserManager extends MainManager
{
    // utilisé pour valider connexion
    public function getPasswordUser($login)
    {
        $req = "SELECT password FROM users WHERE login = :login";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['password'];
    }
    // utilisé pour valider concordance login/password pour envoyer mail si mot de passe oublié
    public function getMailUser($login)
    {
        $req = "SELECT mail FROM users WHERE login = :login";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['mail'];
    }
    // vérifie concordance login/mdp pour connexion
    public function isCombinationValid($login, $password)
    {
        $passwordDB = $this->getPasswordUser($login);
        return password_verify($password, $passwordDB);
    }
    // compte validé par lien mail si option activé ?
    public function isAccountValidated($login)
    {
        $req = "SELECT is_valid FROM users WHERE login = :login";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return ((int)$resultat['is_valid'] === 1 ? true : false);
    }
    //  récupère les infos de l'utilisateur pour page de profil par exemple
    public function getUserInfo($login)
    {
        $req = "SELECT * FROM users WHERE login = :login";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }
    // vérifie si login dispo à la création d'un compte
    public function isLoginFree($login)
    {
        return (empty($this->getUserInfo($login)));
    }
    // enregistre le compte en bdd
    // mettre 1 à is_valid si on veut un compte validé à sa création
    public function registerAccountDB($login, $password, $mail, $account_key, $avatar)
    {
        $req = "INSERT INTO users (login, password, mail, is_valid, role, account_key, avatar, avatar_site)
        VALUES(:login, :password, :mail, 1, 'user', :account_key, :avatar, 1)   
        ";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->bindValue(":account_key", $account_key, PDO::PARAM_INT);
        $stmt->bindValue(":avatar", $avatar, PDO::PARAM_STR);
        $stmt->execute();
        $isCreate = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isCreate;
    }
    //  modifie mail en bdd
    public function modifyMailDB($login, $mail)
    {
        $req = "UPDATE users set mail = :mail WHERE login= :login";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $isValidate = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isValidate;
    }
    // modifie mdp en bdd
    public function modifyPasswordDB($login, $password)
    {
        $req = "UPDATE users set password = :password WHERE login= :login";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
        $isValidate = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isValidate;
    }
    // supprime le compte de la bdd
    public function deleteAccountDB($login)
    {
        $req = "DELETE FROM users WHERE login= :login";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $isValidate = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isValidate;
    }

    // récupère l'avatar d'un utilisateur si générique du site
    public function getImageSiteUser($login)
    {
        $req = "SELECT avatar_site FROM users WHERE login = :login";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['avatar_site'];
    }
    // récupère l'avatar d'un utilisateur si image perso
    public function getImageUser($login)
    {
        $req = "SELECT avatar FROM users WHERE login = :login";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['avatar'];
    }
    // modifie l'avatar en bdd
    public function ModifyAvatarDB($login, $avatar, $avatar_site)
    {
        $req = "UPDATE users set avatar = :avatar, avatar_site = :avatar_site
                      WHERE login = :login
                      ";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":avatar", $avatar, PDO::PARAM_STR);
        $stmt->bindValue(":avatar_site", $avatar_site, PDO::PARAM_INT);
        $stmt->execute();
        $validationOk = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $validationOk;
    }
    // ajoute une image en bdd
    public function addImageDB($login, $avatar, $avatar_site)
    {
        $req = "UPDATE users set avatar = :avatar, avatar_site = :avatar_site
                  WHERE login = :login
                  ";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":avatar", $avatar, PDO::PARAM_STR);
        $stmt->bindValue(":avatar_site", $avatar_site, PDO::PARAM_INT);
        $stmt->execute();
        $validationOk = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $validationOk;
    }
    // ajoute un commentaire d'article en base de données
    public function postCommentDB($id_article, $author, $comment)
    {
        $req = "INSERT INTO comments (id_article, author, comment, date)
        VALUES(:id_article, :author, :comment, NOW())   
        ";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":id_article", $id_article, PDO::PARAM_INT);
        $stmt->bindValue(":author", $author, PDO::PARAM_STR);
        $stmt->bindValue(":comment", $comment, PDO::PARAM_STR);
        $stmt->execute();
        $isCreate = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isCreate;
    }
}
