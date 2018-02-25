<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ArticleManager{
    
    private $_db;
    
    public function __construct() {
        $this->setDb($db);
        
    }
    
    public function add(Article $article){
        
        // assignation content
//        var_dump($article);
        

        
       $q = $this->_db->prepare('INSERT INTO Article(NameArticle, Categorie, Dirphoto, user_iduser, Content) VALUES (:NameArticle, :Categorie, :Dirphoto, :user_iduser, :Content)');
        
        
        $q->bindValue(':NameArticle', $article->getNameArticle());
        $q->bindValue(':Categorie', $article->getCategorie());
        $q->bindValue(':Dirphoto', $article->getDirphoto()); 
        $q->bindValue(':user_iduser', $article->getUser_iduser());
        $q->bindValue(':Content', $article->getContent());
        
        return $q->execute();
        
        
    }
    
    public function delete($article){
        
        // drop row

        $q = $this -> _db -> prepare ('DELETE FROM Article WHERE idArticle ='. $article);
        
        $data = $q->execute();
        
        return $data;
    }
    
    public function get($id){
        
        // recupére row
        
        $id = (int) $id;
        
        $q = $this -> _db ->query('SELECT * FROM Article WHERE idArticle ='.$id);
        
        $data = $q -> fetch (PDO::FETCH_ASSOC);
        
       $data = $Article [] = new Article($data);
        
//        var_dump($data);
        

        
        return  $Article;
    }
    
    public function getListArticle(){
        
        $q = $this->_db->query('SELECT * FROM Article');
        
        
        
    while ($data = $q->fetch(PDO::FETCH_ASSOC)){
        
        $data= $Articles [] = new Article($data);
    }
     
    return $Articles;
    
    }
    
    
    
    public function update(Article $article){
        
    $q = $this->_db->prepare('UPDATE Article SET NameArticle =:NameArticle, Categorie =:Categorie, Dirphoto =:Dirphoto, user_iduser =:user_iduser, dateModificationArticle =:dateModificationArticle, Content =:Content WHERE idArticle=:idArticle');
        
        
    $q->bindValue(':NameArticle', $article->getNameArticle());
    $q->bindValue(':Categorie', $article->getCategorie());
    $q->bindValue(':Dirphoto', $article->getDirphoto()); 
    $q->bindValue(':user_iduser', $article->getUser_iduser());
    $q->bindValue(':Content', $article->getContent());
    $q->bindValue(':dateModificationArticle', $article->getDateModificationArticle());
    $q->bindValue(':idArticle', $article->getIdArticle());

        return $data = $q->execute();
        
    }
    
    public function setDb (){
        
            $db = new PDO('mysql:host=localhost;dbname=BlogJalile', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->_db =$db;
    }
    

}

