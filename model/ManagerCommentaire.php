<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ManagerCommentaire{
    
    private $_db;
    
    public function __construct() {
        $this->setDb($db);
        
    }
    
    public function add(Commentaire $commentaire){
        
        // assignation content
//        var_dump($article);
        

        
       $q = $this->_db->prepare('INSERT INTO Commentaire(ContentCommentaire, CreateDate, user_iduser, Article_idArticle, Valide) VALUES (:ContentCommentaire, :CreateDate, :user_iduser, :Article_idArticle, :Valide)');
        
        
        $q->bindValue(':ContentCommentaire', $commentaire->getContentCommentaire());
        $q->bindValue(':CreateDate', $commentaire->getCreateDate());
        $q->bindValue(':Valide', $commentaire->getValide()); 
        $q->bindValue(':user_iduser', $commentaire->getUser_iduser());
        $q->bindValue(':Article_idArticle', $commentaire->getArticle_idArticle());
        
        return $q->execute();
        
        
    }
    
    public function delete($commenatire){
        
        // drop row

        $q = $this -> _db -> prepare ('DELETE FROM Commentaire WHERE idArticle ='. $commenatire);
        
        $data = $q->execute();
        
        return $data;
    }
    
    public function get($id){
        
        // recupére row
        
        $id = (int) $id;
        
        $q = $this -> _db ->query('SELECT * FROM Commentaire WHERE idCommentaire ='.$id);
        
        $data = $q -> fetch (PDO::FETCH_ASSOC);
        
        $data= $Commentaires [] = new Commentaire($data);
        
//        var_dump($data);
        

        
        return  $Commentaires;
    }
    
    public function getListCommentaireByArticle($Article_idArticle){
        
        $q = $this->_db->query('SELECT * FROM Commentaire WHERE Article_idArticle= '.$Article_idArticle );
        
        
        
    while ($data = $q->fetch(PDO::FETCH_ASSOC)){
        
        $data= $Commentaires [] = new Commentaire($data);
    }
     
    return $Commentaires;
    
    }
    
    
    
    public function update(Commentaire $commentaire){
        
    $q = $this->_db->prepare('UPDATE Article SET NameArticle =:NameArticle, Categorie =:Categorie, Dirphoto =:Dirphoto, user_iduser =:user_iduser, dateModificationArticle =:dateModificationArticle, Content =:Content WHERE idArticle=:idArticle');
        
        
        $q->bindValue(':ContentCommentaire', $commentaire->getContentCommentaire());
        $q->bindValue(':CreateDate', $commentaire->getCreateDate());
        $q->bindValue(':Valide', $commentaire->getValide()); 
        $q->bindValue(':user_iduser', $commentaire->ser_iduser());
        $q->bindValue(':Article_idArticle', $commentaire->getArticle_idArticle());
        $q->bindValue(':idCommentaire', $commentaire->getIdCommentaire());

        return $data = $q->execute();
        
    }
    
    public function setDb (){
        
            $db = new PDO('mysql:host=localhost;dbname=BlogJalile', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->_db =$db;
    }
    

}

