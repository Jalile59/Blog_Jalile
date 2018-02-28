<?php
/**
 *
 */
class User
{
    private $_iduser;
    private $_nameuser;
    private $_surenameuser;
    private $_pseudo;
    private $_emailuser;
    private $_mdpuser;
    private $_photouser;
    private $_statut;



    
    public function __construct($data)
    {
        return $this->hydrate($data);
    }
    /**
     *
     * @return type
     */
    public function getIduser()
    {
        return $this->_iduser;
    }
    
    public function getNameuser()
    {
        return $this->_nameuser;
    }
    
    /**
     *
     * @return type
     */
    public function getSurenameUser()
    {
        return $this->_surenameuser;
    }
    
    public function getPseudo()
    {
        return $this->_pseudo;
    }
    
    public function getEmailUser()
    {
        return $this->_emailuser;
    }
    
    public function getMdpUser()
    {
        return $this->_mdpuser;
    }
    
    public function getPhotoUser()
    {
        return $this->_photouser;
    }
    
    public function getStatut()
    {
        return $this->_statut;
    }
    

    public function hydrate($data)
    {
        foreach ($data as $key => $value) {     ////$key correcspont à l'attribut dans la bdd----$value correspond à la valeur dans la bdd

            $methode = 'set'.ucfirst($key);     //// ucfirst -> mé une majuscule à la premier lettre -> meth

            if (method_exists($this, $methode)) {
                $this->$methode($value);
            }
        }
    }
    
    
    public function setIduser($iduser)
    {
        $this->_iduser =$iduser;
    }
    
    public function setNameUser($nameuser)
    {
        $this->_nameuser =$nameuser;
    }
    
    public function setSurenameUser($surenameuser)
    {
        $this->_surenameuser=$surenameuser;
    }
    
    public function setPseudo($pseudo)
    {
        $this->_pseudo = $pseudo;
    }
    
    public function setEmailUser($emailuser)
    {
        $this->_emailuser = $emailuser;
    }
    
    public function setMdpUser($mdpuser)
    {
        $this->_mdpuser = $mdpuser;
    }
    
    public function setPhotoUser($photouser)
    {
        $this-> _photouser =$photouser;
    }
    
    public function setStatut($statut)
    {
        $this->_statut = $statut;
    }
}
