<?php


require_once("./models/MainManager.model.php");

class VisitorManager extends MainManager
{
    // public function getAllArticles()
    // {
    //     $req = "SELECT * FROM articles ORDER BY id_article desc";
    //     $stmt = $this->getDB()->prepare($req);
    //     $stmt->execute();
    //     $infos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     $stmt->closeCursor();
    //     return $infos;
    // }

    // public function getArticlesByThemes($theme)
    // {

    //     $req = "SELECT * FROM articles WHERE theme = :theme ORDER BY id_article desc";
    //     $stmt = $this->getDB()->prepare($req);
    //     $stmt->bindValue(":theme", $theme, PDO::PARAM_STR);
    //     $stmt->execute();
    //     $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     $stmt->closeCursor();
    //     return $articles;
    // }
    
    // récupération des commentaires pour un article donné en fonctino de son id
    public function getCommentsByArticle($id_article)
    {
        $req = "SELECT * FROM comments WHERE id_article = :id_article ORDER BY id_comment desc";
        $stmt = $this->getDB()->prepare($req);
        $stmt->bindValue(":id_article", $id_article, PDO::PARAM_INT);
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $comments;
    }
}
