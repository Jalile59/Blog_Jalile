<?php

//require './vendor/PhJal/Phjal_ManagerArticle.php';
//require './vendor/PhJal/Phjal_Article.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function addArticle_($NameArticle, $categorie, $Dirphoto, $content){
    
    $article = new Article();
    
    $user_iduser= 1; // replacer par une variable $sessionId

    $data = [
        'NameArticle' =>$NameArticle,
        'Categorie' => $categorie,
        'Dirphoto' => $Dirphoto,
        'content' => $content,
        'user_iduser'=> $user_iduser
    ];
    
    $article->hydrate($data);
    
//  var_dump($article);
    
    
    $db = connect();
    
    $manager = new ArticleManager($db);
    
//    echo $article->getNameArticle();
    return $manager->add($article);

}

function getArticle($id){
    
    $db = connect();
    
    $article = new ArticleManager();
    
    $data = $article->get($id);
    
    $getArticle = new Article();
    $dataArticle = $getArticle->hydrate($data);
    
    return $dataArticle;
}

function connect(){
    
    $db = new PDO('mysql:host=localhost;dbname=BlogJalile', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $db;
}