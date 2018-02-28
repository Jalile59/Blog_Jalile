<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ManagerCommentaire
{
    private $_db;
    
    public function __construct()
    {
        $this->setDb($db);
    }
    
    public function add(Commentaire $commentaire)
    {
        $q = $this->_db->prepare('INSERT INTO Commentaire(ContentCommentaire, CreateDate, user_iduser, Article_idArticle, Valide) VALUES (:ContentCommentaire, :CreateDate, :user_iduser, :Article_idArticle, :Valide)');
        
        
        $q->bindValue(':ContentCommentaire', $commentaire->getContentCommentaire());
        $q->bindValue(':CreateDate', $commentaire->getCreateDate());
        $q->bindValue(':Valide', $commentaire->getValide());
        $q->bindValue(':user_iduser', $commentaire->getUseriduser());
        $q->bindValue(':Article_idArticle', $commentaire->getArticleidArticle());
        
        return $q->execute();
    }
    
    public function delete($idcommentaire)
    {
        
        // drop row

        $q = $this -> _db -> prepare('DELETE FROM Commentaire WHERE idCommentaire =:idCommentaire');
        
        $q->bindValue(':idCommentaire', $idcommentaire);
        
        $data = $q->execute();
        
        return $data;
    }
    
    public function get($idcommentaire)
    {
        
        // recupére row
        
        $id = (int) $id;
        
        $q = $this -> _db ->prepare('SELECT * FROM Commentaire WHERE idCommentaire =:idCommentaire');
        
        $q->bindValue(':idCommentaire', $idcommentaire);
        
        $data = $q->execute();

        
        $data = $q -> fetch(PDO::FETCH_ASSOC);
        
        $data= $Commentaires [] = new Commentaire($data);
        

        
        return  $Commentaires;
    }
    
    public function getListCommentaireByArticle($articleidarticle)
    {
        $q = $this->_db->prepare('SELECT * FROM Commentaire WHERE Article_idArticle=:Article_idArticle');
        
        $q->bindValue(':Article_idArticle', $articleidarticle);
        
        $data = $q->execute();

        
        while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
            $data= $Commentaires [] = new Commentaire($data);
        }
     
        return $Commentaires;
    }
    
    
    
    public function updateCommentaire($contentcommentaire, $idcommentaire)
    {
        $q = $this->_db->prepare('UPDATE Commentaire SET  ContentCommentaire =:ContentCommentaire WHERE idCommentaire=:idCommentaire');
        
        $q->bindValue(':ContentCommentaire', $contentcommentaire);
        $q->bindValue(':idCommentaire', $idcommentaire);

        return $data = $q->execute();
    }
    
    public function validationCommentaire($idcommentaire)
    {
        $q = $this->_db->prepare('UPDATE Commentaire SET Valide =:Valide WHERE idCommentaire=:idCommentaire');
        
        $value = 1;
        
        $q->bindValue(':idCommentaire', $idcommentaire);
        $q->bindValue(':Valide', $value);
        
        return $data = $q->execute();
    }
    
    public function setDb()
    {
        $db = new PDO('mysql:host=localhost;dbname=BlogJalile', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->_db =$db;
    }
}
