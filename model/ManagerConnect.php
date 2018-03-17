<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 class ManagerConnect{
    
     private $_db;
     
     
     public function __construct() 
    {
        $bdd = new PDO('mysql:host=localhost;dbname=BlogJalile', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->_db =$bdd;
        
        return $bdd;
     }
    
    
} 