<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ManagerUser
{
    private $_db;
    
    public function __construct()
    {
        $this->setDb($db);
    }
    
    public function add(User $user)
    {
        
        // assignation content
//        var_dump($article);
        
        
        
        $q = $this->_db->prepare('INSERT INTO user(NameUser, SurenameUser, Pseudo, EmailUser, MdpUser, PhotoUser, Statut ) VALUES (:NameUser, :SurenameUser, :Pseudo, :EmailUser, :MdpUser, :PhotoUser, :Statut)');
        
        
        $q->bindValue(':NameUser', $user->getNameuser());
        $q->bindValue(':SurenameUser', $user->getSurenameUser());
        $q->bindValue(':Pseudo', $user->getPseudo());
        $q->bindValue(':EmailUser', $user->getEmailUser());
        $q->bindValue(':MdpUser', $user->getMdpUser());
        $q->bindValue(':PhotoUser', $user->getPhotoUser());
        $q->bindValue(':Statut', $user->getStatut());
        
        
        return $q->execute();
    }
    
    public function delete($user)
    {
        
        // drop row

        $q = $this -> _db -> prepare('DELETE FROM user WHERE user =user');
        
        $q->bindValue(':user', $user);
        
        $data = $q->execute();
        
        return $data;
    }
    
    public function get($user)
    {
        
        // recupére row
        
        $user = (int) $user;
        
        $q = $this -> _db ->prepare('SELECT * FROM user WHERE user =:user');
        
        $q->bindValue(':user', $user);
        
        $data = $q->execute();
        
        $data = $q -> fetch(PDO::FETCH_ASSOC);
        
        $data = $user [] = new User($data);
        
//        var_dump($data);
        
 

        
        return  $user;
    }
    
    public function getRowbyMail($emailuser)
    {
        $q = $this -> _db ->prepare('SELECT * FROM user WHERE EmailUser =:EmailUser');
        
        $q->bindValue(':EmailUser', $emailuser);
        
        $data = $q->execute();
        
        
        $data = $q -> fetch(PDO::FETCH_ASSOC);
        
        $data = $user [] = new User($data);
        
        
//        die(var_dump($user));

        return $data;
    }
    
    public function getListUser()
    {
        $q = $this->_db->query('SELECT * FROM user');
        
        
        
        while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
            $data= $Articles [] = new Article($data);
        }
     
        return $Articles;
    }
    
    
    
    public function update(User $user)
    {
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
    
    public function setDb()
    {
        $db = new PDO('mysql:host=localhost;dbname=BlogJalile', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->_db =$db;
    }
    
    public function checklogin($emailuser, $mdpuser)
    {
        $q = $this->_db->prepare('SELECT * FROM user WHERE EmailUser =:EmailUser AND MdpUser =:MdpUser');
        //$sql_login2 = ('SELECT * FROM user WHERE Nom="'.$Login.'" AND Mdp="'.$PASS.'"');
        
        $q->bindValue(':EmailUser', $emailuser);
        $q->bindValue(':MdpUser', $mdpuser);

        $q->execute();
        
        $data = $q->rowCount();
        

        if ($data >0) {
            $userObj = new ManagerUser();
            $datas= $userObj->getRowbyMail($emailuser);
            
            
            $_SESSION['Nom']= $datas->getNameuser();
            $_SESSION['Mail']= $datas->getEmailUser();
            $_SESSION['Id'] = $datas->getIduser();
            $_SESSION['Prenom'] = $datas->getSurenameUser();
            $_SESSION['Statut'] = $datas->getStatut();
            
//            die(var_dump($_SESSION));
            return true;
//       var_dump($datas);
            
//           echo $datas->getEmailUser();
        } else {
            return false;
        }
    }
}
