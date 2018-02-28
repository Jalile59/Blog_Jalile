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
    
    if($_SESSION['Nom']){
        
        echo $twig->render('home.twig');
    }else
    
        echo $twig->render('inscription.twig'); 
}

function callConnect($twig){

    if($_SESSION['Nom']){
        
        echo $twig->render('home.twig');
        
    }else{
        
        echo $twig->render('connection.twig');
    }
    
    
}

///////////////////////////////////////////////////////////////////////////////

function AddArticle($NameArticle, $categorie, $Dirphoto, $content, $chapo, $auteur){
      
    
    $user_iduser= $_SESSION['Id']; 
    
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
            'user_iduser'=> $user_iduser,
            'chapo'=> $chapo,
            'Auteur'=> $auteur,
            
        ];

        $article = new Article($data);
        $CheckFile = $article->checkDirphoto($_FILE);
                                                        ///////// probleme si pas de "file"
        if ($CheckFile){





        }else{
            
        }
        
        $manager = new ArticleManager();

        $manager->add($article);
        
        header('Location: index.php?action=article');
        exit();

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
    
    $commentaire = new ManagerCommentaire();
    
    $q = $commentaire->getListCommentaireByArticle($idArticle);
    
    
    
//    die(var_dump($q));
    
    echo $twig->render('viewarticle.twig',array(data=>$data,
                                                commentaire=>$q
                                               ));
}

function dropArticle($id){
    
    $drop = new ArticleManager();
    $requete = $drop->delete($id);
    
    if ($requete){
        
        header('Location: index.php?action=article');
        
        exit();
    }else{
        
        echo 'erreur lors de la suppression de l article';
    }
    
}

function updateArticle ($NameArticle, $categorie, $Dirphoto, $content, $chapo, $auteur,$idArticle){
 
    $user_iduser= $_SESSION['Id']; 
    $date = (date('Y-m-d'));
    
    $data = [
        'NameArticle' =>$NameArticle,
        'Categorie' => $categorie,
        'content' => $content,
        'user_iduser'=> $user_iduser,
        'chapo'=> $chapo,
        'Auteur'=> $auteur,
        'idArticle'=>$idArticle
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
 
    header('Location:index.php?action=home');

    exit();
}

function login($email, $mdp, $twig){
    
    $requete = new ManagerUser();
    
    $q=$requete->checklogin($email, $mdp);
    
    header('Location:index.php?action=home');

    exit();
    }
    


function addcommentaire($commentaire,$idarticle){
    
    $date = date('d-m-Y H:m');
    $user = $_SESSION['Id'];
    
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
    
    header('location: ./index.php?action=viewarticle&idarticle='.$idarticle);

    exit();
    
}

function destroy($twig){
    
    session_destroy();
    
    header('Location:index.php?action=home');

    exit();
}

function validationCommentaire($twig,$idCommentaire,$idarticle){
    
    $requete= new ManagerCommentaire();
    $requete->validationCommentaire($idCommentaire);
    
    header('location: ./index.php?action=viewarticle&idarticle='.$idarticle);
}

function deleteCommentaire($twig,$idCommentaire, $idarticle ){
    
    
    $drop = new ManagerCommentaire();
    $requete = $drop->delete($idCommentaire);
    
    header('location: ./index.php?action=viewarticle&idarticle='.$idarticle);
    
    
}

function modifyCommentaire($twig, $idCommentaire, $idArticle){
    
    $requete = new ManagerCommentaire();
    
    $Modifcommentaire = $requete->get($idCommentaire);
    
//    die(var_dump($requete));
    
    /////////////////////
    
    $dataArticle = new ArticleManager();
    
    $data=$dataArticle->get($idArticle);
    
    $commentaire = new ManagerCommentaire();
    
    $q = $commentaire->getListCommentaireByArticle($idArticle);
    
    
       
    echo $twig->render('viewarticleModifyCommentaire.twig',array(   data=>$data,
                                                                    commentaire=>$q,
                                                                    modifCommentaire=>$Modifcommentaire
                                               ));
    
    /////////////////////
}


function updateCommentaire($commentaire, $idCommentaire, $idarticle){
    
    $data = new ManagerCommentaire;
    
    $requete = $data->updateCommentaire($commentaire, $idCommentaire);
    
    header('location: ./index.php?action=viewarticle&idarticle='.$idarticle);
}