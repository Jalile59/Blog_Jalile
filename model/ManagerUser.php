<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ManagerUser{
    
    private $_db;
    
    public function __construct() {
        $this->setDb($db);
        
    }
    
    public function add(User $user){
        
        // assignation content
//        var_dump($article);
        
        
        
       $q = $this->_db->prepare('INSERT INTO user(NameUser, SurenameUser, Pseudo, EmailUser, MdpUser, PhotoUser ) VALUES (:NameUser, :SurenameUser, :Pseudo, :EmailUser, :MdpUser, :PhotoUser)');
        
        
        $q->bindValue(':NameUser', $user->getNameuser());
        $q->bindValue(':SurenameUser', $user->getSurenameUser());
        $q->bindValue(':Pseudo', $user->getPseudo()); 
        $q->bindValue(':EmailUser', $user->getEmailUser());
        $q->bindValue(':MdpUser', $user->getMdpUser());
        $q->bindValue(':PhotoUser', $user->getPhotoUser());
        
        
        return $q->execute();
        
        
    }
    
    public function delete($user){
        
        // drop row

        $q = $this -> _db -> prepare ('DELETE FROM user WHERE idArticle ='. $article);
        
        $data = $q->execute();
        
        return $data;
    }
    
    public function get($id){
        
        // recupére row
        
        $id = (int) $id;
        
        $q = $this -> _db ->query('SELECT * FROM user WHERE idArticle ='.$id);
        
        $data = $q -> fetch (PDO::FETCH_ASSOC);
        
       $data = $user [] = new User($data);
        
//        var_dump($data);
        
 

        
        return  $user;
    }
    
    public function getRowbyMail ($mail){
        
        $q = $this -> _db ->query('SELECT * FROM user WHERE EmailUser ="'.$mail.'"');
        
        $data = $q -> fetch (PDO::FETCH_ASSOC);
        
        $data = $user [] = new User($data);
        
        
//        die(var_dump($user));

        return $data;
    }
    
    public function getListUser(){
        
        $q = $this->_db->query('SELECT * FROM user');
        
        
        
    while ($data = $q->fetch(PDO::FETCH_ASSOC)){
        
        $data= $Articles [] = new Article($data);
    }
     
    return $Articles;
    
    }
    
    
    
    public function update(User $user){
        
    $q = $this->_db->prepare('UPDATE user SET NameUser =:NameUser, SurenameUser =:SurenameUser, Pseudo =:Pseudo, EmailUser =:EmailUser, MdpUser =:MdpUser, PhotoUser =:PhotoUser WHERE iduser=:iduser');
        
        
        $q->bindValue(':NameUser', $user->getNameuser());
        $q->bindValue(':SurenameUser', $user->setSurenameUser());
        $q->bindValue(':Pseudo', $user->getPseudo()); 
        $q->bindValue(':EmailUser', $user->getEmailUser());
        $q->bindValue(':MdpUser', $user->getMdpUser());
        $q->bindValue(':PhotoUser', $user->getPhotoUser());
        $q->bindValue(':iduser', $user->getIduser());

        return $data = $q->execute();
        
    }
    
    public function setDb (){
        
            $db = new PDO('mysql:host=localhost;dbname=BlogJalile', 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->_db =$db;
    }
    
    public function checklogin($email, $mdp){
        
        $q = $this->_db->query('SELECT * FROM user WHERE EmailUser ="'.$email.'" AND MdpUser ="'.$mdp.'"');
            //$sql_login2 = ('SELECT * FROM user WHERE Nom="'.$Login.'" AND Mdp="'.$PASS.'"');

        
        $data = $q->rowCount();
        
        if ($data >0){
            
            $userObj = new ManagerUser();
            $datas= $userObj->getRowbyMail($email);
            
            
            $_SESSION['Nom']= $datas->getNameuser();
            $_SESSION['Mail']= $datas->getEmailUser();
            $_SESSION['Id'] = $datas->getIduser();
            $_SESSION['Prenom'] = $datas->getSurenameUser();
            

            
            return TRUE;
//            var_dump($datas);
            
//           echo $datas->getEmailUser();
        } else {
        
            return FALSE;
        }
        
        die;
    }
    
    
    

}

