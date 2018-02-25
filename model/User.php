<?php
/**
 * 
 */
class User{
    
    private $_iduser;
    private $_NameUser;
    private $_SurenameUser;
    private $_Pseudo;
    private $_EmailUser;
    private $_MdpUser;
    private $_PhotoUser;



    
    public function __construct($data) {
        
        return $this->hydrate($data);
    }
    /**
     * 
     * @return type
     */
    public function getIduser() {
        
        return $this->_iduser;
    }
    
    public function getNameuser(){
        
        return $this->_NameUser;
    }
    
    /**
     * 
     * @return type
     */
    public function getSurenameUser() {
        
        return $this->_SurenameUser;
        
    }
    
    public function getPseudo(){
        
        return $this->_Pseudo;
        
    }
    
    public function getEmailUser(){
        
        return $this->_EmailUser;
        
    }
    
    public function getMdpUser(){
        
        return $this->_MdpUser;
    }
    
    public function getPhotoUser(){
        
        return $this->_PhotoUser;
    }
    

    public function hydrate($data){
        
        foreach ($data as $key => $value) {     ////$key correcspont à l'attribut dans la bdd----$value correspond à la valeur dans la bdd

            $methode = 'set'.ucfirst($key);     //// ucfirst -> mé une majuscule à la premier lettre -> meth

            if (method_exists($this, $methode)){

                $this->$methode ($value);
                   }
               }
        
        
    }
    
    
    public function setIduser($iduser){
        
        $this->_iduser =$iduser;
    }
    
    public function setNameUser($NameUser){
        
        $this->_NameUser =$NameUser;
    }
    
    public function setSurenameUser($SurenameUser){
        
        $this->_SurenameUser=$SurenameUser;
    }
    
    public function setPseudo($Pseudo){
        
        $this->_Pseudo = $Pseudo;
        
    }
    
    public function setEmailUser($EmailUser){
        
        $this->_EmailUser = $EmailUser;
    }
    
    public function setMdpUser($MdpUser){
        
        
        
        $this->_MdpUser = $MdpUser;
        
    }
    
    public function setPhotoUser($PhotoUser){
        
        $this-> _PhotoUser =$PhotoUser;
    }
    
    
    
    
}

