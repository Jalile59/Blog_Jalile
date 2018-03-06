<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ArticleManager
{
    private $_db;
    
    public function __construct()
    {
        $this->setDb($bdd);
    }
    
    public function addArticle(Article $article)
    {
        $req = $this->_db->prepare('INSERT INTO Article(NameArticle, Categorie, Dirphoto, user_iduser, Content, Chapo, Auteur) VALUES (:NameArticle, :Categorie, :Dirphoto, :user_iduser, :Content, :Chapo, :Auteur)');
        
        
        $req->bindValue(':NameArticle', $article->getNameArticle());
        $req->bindValue(':Categorie', $article->getCategorie());
        $req->bindValue(':Dirphoto', $article->getDirphoto());
        $req->bindValue(':user_iduser', $article->getUser_iduser());
        $req->bindValue(':Content', $article->getContent());
        $req->bindValue(':Chapo', $article->getChapo());
        $req->bindValue(':Auteur', $article->getAuteur());

        
        return $req->execute();
    }
    
    public function delete($idarticle)
    {
        
        // drop row

        $req = $this -> _db -> prepare('DELETE FROM Article WHERE idArticle =:idArticle');
        
        $req->bindValue(':idArticle', $idarticle);
        
        
        $data = $req->execute();
        
        return $data;
    }
    
    public function get($idarticle)
    {
        
        // recupére row
        
        $req = $this -> _db ->prepare('SELECT * FROM Article WHERE idArticle =:idArticle');
        
        $req->bindValue(':idArticle', $idarticle);
        
         $req->execute();

        
        $data = $req -> fetch(PDO::FETCH_ASSOC);
        
         $Article [] = new Article($data);
        
        

        
        return  $Article;
    }
    
    public function getListArticle()
    {
        $req = $this->_db->query('SELECT * FROM Article ORDER BY CreateDateArticle DESC');
        
        
        
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $Articles [] = new Article($data);
        }
     
        return $Articles;
    }
    
    
    
    public function update(Article $article)
    {
        $req = $this->_db->prepare('UPDATE Article SET NameArticle =:NameArticle, Categorie =:Categorie, Dirphoto =:Dirphoto, user_iduser =:user_iduser, dateModificationArticle =:dateModificationArticle, Content =:Content, Chapo=:Chapo, Auteur =:Auteur WHERE idArticle=:idArticle');
        
        
        $req->bindValue(':NameArticle', $article->getNameArticle());
        $req->bindValue(':Categorie', $article->getCategorie());
        $req->bindValue(':Dirphoto', $article->getDirphoto());
        $req->bindValue(':user_iduser', $article->getUser_iduser());
        $req->bindValue(':Content', $article->getContent());
        $req->bindValue(':dateModificationArticle', $article->getDateModificationArticle());
        $req->bindValue(':idArticle', $article->getIdArticle());
        $req->bindValue(':Chapo', $article->getChapo());
        $req->bindValue(':Auteur', $article->getAuteur());



        return  $req->execute();
    }
    
    public function getDirphotoByIdarticle($idarticle){
        
        $req = $this->_db->prepare('SELECT `Dirphoto` FROM `Article`WHERE `idArticle`=:idArticle');
        
        $req->bindValue(':idArticle', $idarticle);
        $req->execute();
        
        $data = $req->fetch(PDO::FETCH_ASSOC);
        
        return $data;
        
    }
    
    public function setDb()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=BlogJalile', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->_db =$bdd;
    }
    

}
