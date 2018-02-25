<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ArticleManager{
    
    private $_db;
    
    public function __construct($db) {
        $this->setDb($db);
        
    }
    
    public function add(Article $article){
        
        // assignation content
//        var_dump($article);
        
        
        
       $q = $this->_db->prepare('INSERT INTO Article(NameArticle, Categorie, Dirphoto, user_iduser, Content) VALUES (:NameArticle, :Categorie, :Dirphoto, :user_iduser, :Content)');
        
        
        $q->bindValue(':NameArticle', $article->getNameArticle());
        $q->bindValue(':Categorie', $article->getCategorie());
        $q->bindValue(':Dirphoto', $article->getDirphoto()); ///creer get class article
        $q->bindValue(':user_iduser', $article->getUser_iduser());
        $q->bindValue(':Content', $article->getContent());/////creer get class article
        
        return $q->execute();
        
        
    }
    
    public function delete(Article $article){
        
        // drop row
        
        $q = $this -> _db -> prepare ('DELETE FROM Article WHERE id ='. $article->getid());
        
        $q->execute();
    }
    
    public function get($id){
        
        // recupére row
        
        $id = (int) $id;
        
        $q = $this -> _db ->query('SELECT * FROM Article WHERE id ='.$id);
        
        $data = $q -> fetch (PDO::FETCH_ASSOC);
        
        return new Phjal\Article($data);
    }
    
    public function getList(){
        
    }
    
    public function update(Article $article){
        
        
    }
    
    public function setDb (PDO $db){
        
        $this->_db =$db;
    }
}