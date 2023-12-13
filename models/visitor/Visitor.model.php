<?php


require_once("./models/MainManager.model.php");

class VisitorManager extends MainManager
{
    public function getAllArticles()
    {
        $req = "SELECT * FROM articles ORDER BY id_article desc";
        $stmt = $this->getDB()->prepare($req);
        $stmt->execute();
        $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $infos;
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
