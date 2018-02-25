<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class View{
    
    
    private $twig;
    
    
    public function __construct(){
        
        $loader = new Twig_Loader_Filesystem('templates');

        $this->twig = new Twig_Environment ($loader, [
        'cache' => FALSE
        ]);
        
        $this->twig->addExtension(new Twig_Extension_Debug);
        
    }
    
    public function setView($templateName){
        
        return $this->twig->render($templateName);
        
        
    }
    
    public function  setViewVar($templateName, $data){
        
        
        return $this->twig->render($templateName,$data);
        
    }
}
