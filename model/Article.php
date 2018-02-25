<?php
/**
 * 
 */
class Article{
    
    private $_idArticle;
    private $_NameArticle;
    private $_Categorie;
    private $_Dirphoto;
    private $_DateModificationArticle;
    private $_content;
    private $_User_iduser;
    private $_CreateDate;



    
    public function __construct($data) {
        
        return $this->hydrate($data);
    }
    /**
     * 
     * @return type
     */
    public function getIdArticle() {
        
        return $this->_idArticle;
    }
    
    public function getCreateDate(){
        
        return $this->_CreateDate;
    }
    
    /**
     * 
     * @return type
     */
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
    
    public function setDateModificationArticle($DateModificationArticle){
        
        $this->_DateModificationArticle =$DateModificationArticle;
    }
    
    public function setCreateDate($CreateDate){
        
        $this->_CreateDate=$CreateDate;
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
    
    
    public function checkDirphoto($_FILE){
        
    
    $extention = new SplFileInfo ($_FILES['photoAticle']['name']);
    
    
    if ($_FILES ['photoAticle']['error']== 0){
                
        if(mb_strtolower($extention->getExtension()) =='png'or mb_strtolower($extention->getExtension()) == 'jpg'){
            
            if ($_FILES ['photoAticle']['size']<= 2000000){ //valeur en octets
                
                $name = md5($_FILES['photoAticle']['name']); // modifier uid unique
                $destination = './public/img/'.$name.'.'.$extention->getExtension(); // 
                
                
                move_uploaded_file($_FILES ['photoAticle']['tmp_name'], $destination);
                
                $this->_Dirphoto = $destination;
                
                return TRUE;
            }
            
        }
    } else {   
            
        return FALSE;
    }
        
        
    }
    
    
    
}

