<?php




class Article{
    
    private $_idArticle;
    private $_NameArticle;
    private $_Categorie;
    private $_Dirphoto;
    private $_DateModificationArticle;
    private $_content;
    private $_User_iduser;




    public function getIdArticle() {
        
        return $this->_idArticle;
    }
    
    public function getNameArticle() {
        
        return $this->_NameArticle;
        
    }
    
    public function getCategorie(){
        
        return $this->_Categorie;
        
    }
    
    public function getDirphoto(){
        
        return $this->_Dirphoto;
        
    }
    
    public function getContent(){
        
        return $this->_content;
    }
    
    public function getDateModificationArticle(){
        
        return $this->_DateModificationArticle;
    }
    
    public function getUser_iduser (){
        
        
        return $this->_User_iduser;
    }




    public function hydrate($data){
        
        foreach ($data as $key => $value) {     ////$key correcspont à l'attribut dans la bdd----$value correspond à la valeur dans la bdd

            $methode = 'set'.ucfirst($key);     //// ucfirst -> mé une majuscule à la premier lettre -> meth

            if (method_exists($this, $methode)){

                $this->$methode ($value);
                   }
               }
        
        
    }
    
    
    public function setIdArticle($idArticle){
        
        $this->_idArticle =$idArticle;
    }
    
    public function setNameArticle($NameArticle){
        
        $this->_NameArticle = $NameArticle;
        
    }
    
    public function setCategorie($Catégorie){
        
        $this->_Categorie = $Catégorie;
    }
    
    public function setDirphoto($Dirphoto){
        
        $this->_Dirphoto = $Dirphoto;
        
    }
    
    public function setContent($Content){
        
        $this-> _content =$Content;
    }
    
    public function setUser_iduser($User_iduser){
        
        $this->_User_iduser=$User_iduser;
    }
}