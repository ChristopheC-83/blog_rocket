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
    public function  getChoosenTheme($theme){
        $req = $this->getDB()->prepare("SELECT * FROM themes WHERE theme = :theme");
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

    public function getAllArticles()
    {
        $req = "SELECT * FROM articles ORDER BY id_article desc";
        $stmt = $this->getDB()->prepare($req);
        $stmt->execute();
        $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $infos;
    }

    public function  getOneArticle($id){
        $req = "SELECT * FROM articles WHERE id_article = :id_article";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":id_article", $id, PDO::PARAM_INT);
        $stmt->execute();
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $article;
    }

    public function getArticlesByThemes($theme){ 
    
    $req = "SELECT * FROM articles WHERE theme = :theme ORDER BY id_article desc";
    $stmt = $this->getDB()->prepare($req);
    $stmt->bindValue(":theme", $theme, PDO::PARAM_STR);
    $stmt->execute();
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $articles;
    }
}