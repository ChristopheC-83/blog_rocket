<?php


require_once("./models/User/User.model.php");

class AdministratorManager extends UserManager
{
    //  récupère les infos de tous les utilisateurs pour gestions comptes
    public function getUsers()
    {
        $req = "SELECT * FROM users ";
        $stmt = $this->getDB()->prepare($req);
        $stmt->execute();
        $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $infos;
    }
    // modifie role en bdd
    public function modifyRoleDB($login, $role)
    {
        $req = "UPDATE users set role = :role WHERE login= :login ";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":role", $role, PDO::PARAM_STR);
        $stmt->execute();
        $isValidate = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isValidate;
    }
    // modifie statut en bdd
    public function modifyStateDB($login, $is_valid)
    {
        $req = "UPDATE users set is_valid = :is_valid WHERE login= :login ";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":is_valid", $is_valid, PDO::PARAM_INT);
        $stmt->execute();
        $isValidate = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isValidate;
    }

    public function  deleteThemeDB($id_theme)
    {
        $req = "DELETE FROM themes WHERE id_theme = :id_theme";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":id_theme", $id_theme, PDO::PARAM_INT);
        $stmt->execute();
        $isValidate = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isValidate;
    }

    public function createThemeDB($theme, $description_theme, $color)
    {

        $req = "INSERT INTO themes (theme, description_theme, color) VALUES (:theme, :description_theme, :color)";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":theme", $theme, PDO::PARAM_STR);
        $stmt->bindValue(":description_theme", $description_theme, PDO::PARAM_STR);
        $stmt->bindValue(":color", $color, PDO::PARAM_STR);
        $stmt->execute();
        $isValidate = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isValidate;
    }

    //  récupère les infos d'un article en fonction de son titre
    public function getArticleByTitle($title)
    {
        $req = "SELECT * FROM articles WHERE title = :title";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }
    // vérifie si titre dispo à la création d'un article
    public function isTitleFree($title)
    {
        return (empty($this->getArticleByTitle($title)));
    }
    //  récupère les infos d'un article en fonction de son url
    public function getArticleByUrl($url)
    {
        $req = "SELECT * FROM articles WHERE url = :url";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":url", $url, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }
    // vérifie si url dispo à la création d'un article
    public function isUrlFree($url)
    {
        return (empty($this->getArticleByURL($url)));
    }

    // creation article en base de données
    public function  createArticleDB($title, $theme, $pitch, $url)
    {
        $req = "INSERT INTO articles (title, theme, pitch, url) VALUES (:title, :theme, :pitch, :url)";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":theme", $theme, PDO::PARAM_STR);
        $stmt->bindValue(":pitch", $pitch, PDO::PARAM_STR);
        $stmt->bindValue(":url", $url, PDO::PARAM_STR);
        $stmt->execute();
        $isValidate = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isValidate;
    }
}
