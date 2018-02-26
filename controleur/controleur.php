<?php

require './model/ManagerArticle.php';
require './model/model_old.php';

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function callAddArticle (){
    
    echo $twig->render('newArticle.twig');
    
}


function callArticle(){
    
    echo $twig->render('article.twig');
    
}

function callHome($twig){
    

    echo $twig->render('home.twig');
    
}

function callInscription($twig){
    
    echo $twig->render('inscription.twig'); 
}

function callConnect($twig){

    
    echo $twig->render('connection.twig');
}

///////////////////////////////////////////////////////////////////////////////

function AddArticle($NameArticle, $categorie, $Dirphoto, $content){
      
    
    $user_iduser= 1; // replacer par une variable $sessionId
    
    // Verificatiuon des champs postés
    
    $errors = array();
    
    if ( empty($NameArticle) ) {
        $errors[] = 'Veuillez renseigner le titre';
    }
    if ( empty($content) ) {
        $errors[] = 'Veuillez renseigner le contenu';
    }
    
    // Si erreurs
    if ( !empty($error) ) {
        $twig->render ('newArticle.twig',array('errors' => $errors, 'postParams'=> $_POST));
    }    
    else {    

        $data = [
            'NameArticle' =>$NameArticle,
            'Categorie' => $categorie,
            'content' => $content,
            'user_iduser'=> $user_iduser
        ];

        $article = new Article($data);
        $CheckFile = $article->checkDirphoto($_FILE);
                                                        ///////// probleme si pas de "file"
        if ($CheckFile){

        $manager = new ArticleManager();

        $manager->add($article);

        header('Location: index.php?action=article');

        exit();

        }else{
                                    ////////////// Ajouter si upload fichier NOKS
        }
    }

}

function getListArticle($twig){
      
    $listeArticle = new ArticleManager();
    
    $data= $listeArticle->getListArticle();
        
//    var_dump($data);
    
 
    
//    die(var_dump($data));
    
    echo   $twig->render ('article.twig',array(data =>$data));


            
    
    
}

function viewArticle($twig, $idArticle){
    
    $dataArticle = new ArticleManager();
    
    $data=$dataArticle->get($idArticle);
    
//    die(var_dump($data));
    echo $twig->render('viewarticle.twig',array(data=>$data));
}

function dropArticle($id){
    
    $drop = new ArticleManager();
    $requete = $drop->delete($id);
    
    if ($requete){
        
        header('Location: index.php?action=article');
    }else{
        
        echo 'erreur lors de la suppression de l article';
    }
    
}

function updateArticle ($NameArticle, $categorie, $Dirphoto, $content, $id){
 
    $user_iduser= 1; // replacer par une variable $sessionId
    $date = (date('Y-m-d'));
    
    $data = [
    'NameArticle' =>$NameArticle,
    'Categorie' => $categorie,
    'content' => $content,
    'user_iduser'=> $user_iduser,
    'idArticle'=>$id,
    'DateModificationArticle'=> $date
    ];
    
    
    
    $article = new Article($data);
    
    $CheckFile = $article->checkDirphoto($_FILE);
    
    $upArticle= new ArticleManager();
    $requete = $upArticle->update($article);
    
    header('Location: index.php?action=article');
}

function viewModifyArticle($twig,$id){
    
    $dataArticle = new ArticleManager();
    
    $data=$dataArticle->get($id);
    
    $data = array(
        'data'=>$data,
        'session' => $_SESSION    
    );
    
    
    
    echo $twig->render('modifyArticle.twig',array(data=>$data));    
    
}

function addinscription($name, $surename, $pseudo, $mail, $mdp){
    
    $data = [
      'NameUser' => $name,
      'SurenameUser' => $surename,
      'Pseudo' => $pseudo,
      'EmailUser' => $mail,
      'MdpUser' => $mdp,
      'PhotoUser' => $Dirphoto
        
    ];
    
    $inscription = new User($data);
    
//    die(var_dump($inscription));
    
  
    $addinscription = new ManagerUser();
    $requete = $addinscription->add($inscription);
    
}

function login($email, $mdp, $twig){
    
    $requete = new ManagerUser();
    
    $q=$requete->checklogin($email, $mdp);
    
    header('Location:index.php?action=home');

    exit();
    }
    


function addcommentaire($commentaire,$idarticle){
    
    $date = date('d-m-Y H:M');
    $user = 1;
    
    $data=[
        ContentCommentaire => $commentaire,
        Article_idArticle => $idarticle,
        CreateDate => $date,
        user_iduser => $user
    ];
    
//    echo $commentaire;
    $commentaires = new Commentaire($data);
    
//    die(var_dump($commentaires));
    $requete = new ManagerCommentaire();
    
    $requete->add($commentaires);
    
    header('Location:index.php?action=ViewModify&Articleid='.$idarticle);

    exit();
    
}

function destroy($twig){
    
    session_destroy();
    
    header('Location:index.php?action=home');

    exit();
}