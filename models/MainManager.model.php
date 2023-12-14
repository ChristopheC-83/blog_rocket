<?php
require_once("PDO.model.php");

class MainManager extends Model{

    public function getUsers(){
        $req = $this->getDB()->prepare("SELECT * FROM users");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }

    public function getAllThemes(){
        $req = $this->getDB()->prepare("SELECT * FROM themes");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }

    public function  getColorTheme($theme){
        $req = $this->getDB()->prepare("SELECT color FROM themes WHERE theme = :theme");
        $req->bindValue(":theme", $theme, PDO::PARAM_STR);
        $req->execute();
        $datas = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }

    public function  getPalette(){ 
        $req = "SELECT * FROM palette";
        $stmt = $this->getDB()->prepare($req);
        $stmt->execute();
        $datas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $datas;
    
    
    }
}