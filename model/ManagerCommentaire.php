<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ManagerCommentaire extends ManagerConnect
{
    private $_db;
    
    public function __construct()
    {
        $this->_db = parent::__construct();
        
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
        $req = $this->_db->prepare('SELECT * FROM Commentaire INNER JOIN user ON `user`.`iduser` = `Commentaire`.`user_iduser` AND `Commentaire`. `Article_idArticle`=:Article_idArticle');
        
        $req->bindValue(':Article_idArticle', $articleidarticle);
        
        $data = $req->execute();
        
        $commentaires= '';
        
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $commentaires [] = new Commentaire($data);
        }
        return $commentaires;
    }
    
    
    
    public function updateCommentaire($contentcommentaire, $idcommentaire)
    {
        $req = $this->_db->prepare('UPDATE Commentaire SET  ContentCommentaire =:ContentCommentaire WHERE idCommentaire=:idCommentaire');
        
        $req->bindValue(':ContentCommentaire', $contentcommentaire);
        $req->bindValue(':idCommentaire', $idcommentaire);

        return  $req->execute();
    }
    
    public function validationCommentaire($idcommentaire)
    {
        $req = $this->_db->prepare('UPDATE Commentaire SET Valide =:Valide WHERE idCommentaire=:idCommentaire');
        
        $value = 1;
               
        $req->bindValue(':idCommentaire', $idcommentaire);
        $req->bindValue(':Valide', $value);
        
        return  $req->execute();
    }
      
    public function getallcommentaire(){
        
        $req = $this->_db->prepare('SELECT * FROM `Commentaire` INNER JOIN `user` ON `user`.`iduser`= `Commentaire`.`user_iduser` JOIN `Article` ON `Commentaire`.`Article_idArticle`=`Article`.`idArticle`ORDER BY `Commentaire`.`CreateDate` DESC, `Commentaire`.`Valide`');
        
         $req->execute();
                
       
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            
            $Commentaires [] = new Commentaire($data);
        }
              
    return $Commentaires;
        
    }
    
}   
