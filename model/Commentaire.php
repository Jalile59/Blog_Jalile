<?php
/**
 * 
 */
class Commentaire{
    
    private $_idCommentaire;
    private $_ContentCommentaire;
    private $_CreateDate;
    private $_user_iduser;
    private $_Article_idArticle;
    private $_Valide;



    
    public function __construct($data) {
        
        return $this->hydrate($data);
    }
    /**
     * 
     * @return type
     */
    public function getIdCommentaire() {
        
        return $this->_idCommentaire;
    }
    
    public function getContentCommentaire(){
        
        return $this->_ContentCommentaire;
    }
    
    /**
     * 
     * @return type
     */
    public function getCreateDate() {
        
        return $this->_CreateDate;
        
    }
    
    public function getUser_iduser(){
        
        return $this->_user_iduser;
        
    }
    
    public function getArticle_idArticle(){
        
        return $this->_Article_idArticle;
        
    }
    
    public function getValide(){
        
        return $this->_Valide;
    }
    




    public function hydrate($data){
        
        foreach ($data as $key => $value) {     ////$key correcspont à l'attribut dans la bdd----$value correspond à la valeur dans la bdd

            $methode = 'set'.ucfirst($key);     //// ucfirst -> mé une majuscule à la premier lettre -> meth

            if (method_exists($this, $methode)){

                $this->$methode ($value);
                   }
               }
        
        
    }
    
    
    public function setIdCommentaire($idCommentaire){
        
        $this->_idCommentaire =$idCommentaire;
    }
    
    public function setContentCommentaire($ContentCommentaire){
        
        $this->_ContentCommentaire =$ContentCommentaire;
    }
    
    public function setCreateDate($CreateDate){
        
        $this->_CreateDate=$CreateDate;
    }
    
    public function setUser_iduser($user_iduser){
        
        $this->_user_iduser = $user_iduser;
        
    }
    
    public function setArticle_idArticle($Article_idArticle){
        
        $this->_Article_idArticle = $Article_idArticle;
    }
    
    public function setValide($Valide){

        $this->_Valide = $Valide;
        
    }
    
    
    

}
