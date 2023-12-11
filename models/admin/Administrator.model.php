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

    public function createThemeDB($theme, $description_theme){ 
    
        $req = "INSERT INTO themes (theme, description_theme) VALUES (:theme, :description_theme)";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":theme", $theme, PDO::PARAM_STR);
        $stmt->bindValue(":description_theme", $description_theme, PDO::PARAM_STR);
        $stmt->execute();
        $isValidate = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $isValidate;}
}
