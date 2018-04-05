<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ManagerUser extends ManagerConnect
{
    private $_db;
    
    public function __construct()
    {
        $this->_db = parent::__construct();
    }
    
    public function add(User $user)
    {
        $req = $this->_db->prepare('INSERT INTO user(NameUser, SurenameUser, Pseudo, EmailUser, MdpUser, PhotoUser, Statut ) VALUES (:NameUser, :SurenameUser, :Pseudo, :EmailUser, :MdpUser, :PhotoUser, :Statut)');
        
        
        $req->bindValue(':NameUser', $user->getNameuser());
        $req->bindValue(':SurenameUser', $user->getSurenameUser());
        $req->bindValue(':Pseudo', $user->getPseudo());
        $req->bindValue(':EmailUser', $user->getEmailUser());
        $req->bindValue(':MdpUser', $user->getMdpUser());
        $req->bindValue(':PhotoUser', $user->getPhotoUser());
        $req->bindValue(':Statut', $user->getStatut());
        
        
        return $data= $req->execute();
    }
    
    public function delete($user)
    {
        
        // drop row

        $req = $this -> _db -> prepare('DELETE FROM user WHERE user =user');
        
        $req->bindValue(':user', $user);
        
        $data = $req->execute();
        
        return $data;
    }
    
    public function get($user)
    {
        
        // recupére row
                
        $req = $this -> _db ->prepare('SELECT * FROM user WHERE user =:user');
        
        $req->bindValue(':user', $user);
        
        $req->execute();
        
        $req -> fetch(PDO::FETCH_ASSOC);
        
        $data = $user [] = new User($data);
        
//        var_dump($data);
        
 

        
        return  $user;
    }
    
    public function getRowbyMail($emailuser)
    {
        $req = $this -> _db ->prepare('SELECT * FROM user WHERE EmailUser =:EmailUser');
        
        $req->bindValue(':EmailUser', $emailuser);
        
        $req->execute();
        
        
        $data = $req -> fetch(PDO::FETCH_ASSOC);
        
       $users = $user [] = new User($data);
        
        

        return $users;
    }
    
    public function getListUser()
    {
        $req = $this->_db->query('SELECT * FROM user');
        
        
        
        while ($req->fetch(PDO::FETCH_ASSOC)) {
            $data= $Articles [] = new Article($data);
        }
     
        return $Articles;
    }
    
    
    
    public function update(User $user)
    {
        $req = $this->_db->prepare('UPDATE user SET NameUser =:NameUser, SurenameUser =:SurenameUser, Pseudo =:Pseudo, EmailUser =:EmailUser, MdpUser =:MdpUser, PhotoUser =:PhotoUser WHERE iduser=:iduser');
        
        
        $req->bindValue(':NameUser', $user->getNameuser());
        $req->bindValue(':SurenameUser', $user->setSurenameUser());
        $req->bindValue(':Pseudo', $user->getPseudo());
        $req->bindValue(':EmailUser', $user->getEmailUser());
        $req->bindValue(':MdpUser', $user->getMdpUser());
        $req->bindValue(':PhotoUser', $user->getPhotoUser());
        $req->bindValue(':iduser', $user->getIduser());

        return $data = $req->execute();
    }
    
    public function setDb()
    {
        $bdd = new PDO('mysql:host=localhost;dbname=BlogJalile', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->_db =$bdd;
    }
    
    public function checklogin($emailuser, $mdpuser)
    {
        $req = $this->_db->prepare('SELECT * FROM user WHERE EmailUser =:EmailUser AND MdpUser =:MdpUser');
        //$sql_login2 = ('SELECT * FROM user WHERE Nom="'.$Login.'" AND Mdp="'.$PASS.'"');
        
        $req->bindValue(':EmailUser', $emailuser);
        $req->bindValue(':MdpUser', $mdpuser);

        $req->execute();
        
        $data = $req->rowCount();
        
        

        if ($data >0) {
                       
            $userObj = new ManagerUser();
            $datas= $userObj->getRowbyMail($emailuser);

            $_SESSION['Nom']= $datas->getNameuser();
            $_SESSION['Mail']= $datas->getEmailUser();
            $_SESSION['Id'] = $datas->getIduser();
            $_SESSION['Prenom'] = $datas->getSurenameUser();
            $_SESSION['Statut'] = $datas->getStatut();

            return true;
        } else {
            return false;
        }
    }
    
    public function checkemailexist($mail)
    {
        $req = $this->_db->prepare('SELECT COUNT(*) FROM `user` WHERE EmailUser =:Mail ');
        
        $req->bindValue(':Mail', $mail);
        
        $req->execute();
        
        $data = $req->fetch();
//       var_dump($mail);
//   die(var_dump($data[0]));
//        
        
        if ($data[0] == 1){
            
            return 1;
            
        }else{
            
            return 0;
        }
        
    }
    
        public function checkpseudolexist($pseudo)
    {
        $req = $this->_db->prepare('SELECT COUNT(*) FROM `user` WHERE Pseudo =:pseudo ');
        
        $req->bindValue(':pseudo', $pseudo);
        
        $req->execute();
        
        $data = $req->fetch();
//       var_dump($mail);
//   die(var_dump($data[0]));
//        
        
        if ($data[0] == 1){
            
            return 1;
            
        }else{
            
            return 0;
        }
        
    }
}
