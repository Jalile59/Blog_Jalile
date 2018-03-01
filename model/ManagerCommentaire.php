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
        $this->setDb($bdd);
    }
    
    public function add(Commentaire $commentaire)
    {
        $req = $this->_db->prepare('INSERT INTO Commentaire(ContentCommentaire, CreateDate, user_iduser, Article_idArticle, Valide) VALUES (:ContentCommentaire, :CreateDate, :user_iduser, :Article_idArticle, :Valide)');
        
        
        $req->bindValue(':ContentCommentaire', $commentaire->getContentCommentaire());
        $req->bindValue(':CreateDate', $commentaire->getCreateDate());
        $req->bindValue(':Valide', $commentaire->getValide());
        $req->bindValue(':user_iduser', $commentaire->getUseriduser());
        $req->bindValue(':Article_idArticle', $commentaire->getArticleidArticle());
        
        return $req->execute();
    }
    
    public function delete($idcommentaire)
    {
        
        // drop row

        $req = $this -> _db -> prepare('DELETE FROM Commentaire WHERE idCommentaire =:idCommentaire');
        
        $req->bindValue(':idCommentaire', $idcommentaire);
        
        $data = $req->execute();
        
        return $data;
    }
    
    public function get($idcommentaire)
    {
        
        // recupére row
        
        $id = (int) $id;
        
        $req = $this -> _db ->prepare('SELECT * FROM Commentaire WHERE idCommentaire =:idCommentaire');
        
        $req->bindValue(':idCommentaire', $idcommentaire);
        
        $req->execute();

        
        $data = $req -> fetch(PDO::FETCH_ASSOC);
        
        $Commentaires [] = new Commentaire($data);
        

        
        return  $Commentaires;
    }
    
    public function getListCommentaireByArticle($articleidarticle)
    {
        $req = $this->_db->prepare('SELECT * FROM Commentaire WHERE Article_idArticle=:Article_idArticle');
        
        $req->bindValue(':Article_idArticle', $articleidarticle);
        
        $data = $req->execute();

        
        while ($req->fetch(PDO::FETCH_ASSOC)) {
            $data= $Commentaires [] = new Commentaire($data);
        }
     
        return $Commentaires;
    }
    
    
    
    public function updateCommentaire($contentcommentaire, $idcommentaire)
    {
        $req = $this->_db->prepare('UPDATE Commentaire SET  ContentCommentaire =:ContentCommentaire WHERE idCommentaire=:idCommentaire');
        
        $req->bindValue(':ContentCommentaire', $contentcommentaire);
        $req->bindValue(':idCommentaire', $idcommentaire);

        return $data = $req->execute();
    }
    
    public function validationCommentaire($idcommentaire)
    {
        $req = $this->_db->prepare('UPDATE Commentaire SET Valide =:Valide WHERE idCommentaire=:idCommentaire');
        
        $value = 1;
        
        $req->bindValue(':idCommentaire', $idcommentaire);
        $req->bindValue(':Valide', $value);
        
        return $data = $req->execute();
    }
    
    public function setDb()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=BlogJalile', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->_db =$bdd;
    }
}
