<?php

require './model/ManagerArticle.php';
require './model/model_old.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function callAddArticle()
{
    echo $twig->render('newArticle.twig');
}


function callArticle()
{
    echo $twig->render('article.twig');
}

function callHome($twig)
{
    echo $twig->render('home.twig');
}

function callInscription($twig)
{
    if ($_SESSION['Nom']) {
        echo $twig->render('home.twig');
    } else {
        echo $twig->render('inscription.twig');
    }
}

function callConnect($twig)
{
    if ($_SESSION['Nom']) {
        echo $twig->render('home.twig');
    } else {
        echo $twig->render('connection.twig');
    }
}

///////////////////////////////////////////////////////////////////////////////

function addarticle($namearticle, $categorie, $content, $chapo, $auteur)
{
    $user_iduser= $_SESSION['Id'];
    
    // Verificatiuon des champs postés
    
    $errors = array();
    
    if (empty($namearticle)) {
        $errors[] = 'Veuillez renseigner le titre';
    }
    if (empty($content)) {
        $errors[] = 'Veuillez renseigner le contenu';
    }
    
    // Si erreurs
    if (!empty($error)) {
        $twig->render('newArticle.twig', array('errors' => $errors, 'postParams'=> $_POST));
    } else {
        $data = [
            'NameArticle' =>$namearticle,
            'categorie' => $categorie,
            'Content' => $content,
            'useriduser'=> $user_iduser,
            'chapo'=> $chapo,
            'Auteur'=> $auteur,
            
        ];

        $article = new Article($data);
        $CheckFile = $article->checkDirphoto($_FILE);
        ///////// probleme si pas de "file"
        if ($CheckFile) {
        } else {
        }
        
        $manager = new ArticleManager();

        $manager->addArticle($article);
        
        header('Location: index.php?action=article');
        exit();
    }
}

function getListArticle($twig)
{
    $listeArticle = new ArticleManager();
    
    $data= $listeArticle->getListArticle();
        
//    var_dump($data);
    
 
    
//    die(var_dump($data));
    
    echo   $twig->render('article.twig', array(data =>$data));
}

function viewArticle($twig, $idarticle)
{
    $dataArticle = new ArticleManager();
    
    $data=$dataArticle->get($idarticle);
    
    $commentaire = new ManagerCommentaire();
    
    $q = $commentaire->getListCommentaireByArticle($idarticle);
    
    
    
//    die(var_dump($q));
    
    echo $twig->render('viewarticle.twig', array(data=>$data,
                                                commentaire=>$q
                                               ));
}

function dropArticle($id)
{
    $drop = new ArticleManager();
    $requete = $drop->delete($id);
    
    if ($requete) {
        header('Location: index.php?action=article');
        
        exit();
    } else {
        echo 'erreur lors de la suppression de l article';
    }
}

function updateArticle($aamearticle, $categorie, $dirphoto, $content, $chapo, $auteur, $idarticle)
{
    $user_iduser= $_SESSION['Id'];
    $date = (date('Y-m-d'));
    
    $data = [
        'NameArticle' =>$namearticle,
        'Categorie' => $categorie,
        'Content' => $content,
        'useriduser'=> $user_iduser,
        'chapo'=> $chapo,
        'Auteur'=> $auteur,
        'idArticle'=>$idarticle
    ];
    
    
    
    $article = new Article($data);
    
    $CheckFile = $article->checkDirphoto($_FILE);
    
    $uparticle= new ArticleManager();
    $requete = $uparticle->update($article);
    
    header('Location: index.php?action=article');
}

function viewModifyArticle($twig, $id)
{
    $dataArticle = new ArticleManager();
    
    $data=$dataArticle->get($id);
    

    
    
    
    echo $twig->render('modifyArticle.twig', array(data=>$data));
}

function addinscription($name, $surename, $pseudo, $mail, $mdp)
{
    $data = [
      'NameUser' => $name,
      'SurenameUser' => $surename,
      'Pseudo' => $pseudo,
      'EmailUser' => $mail,
      'MdpUser' => $mdp,        
    ];
    
    $inscription = new User($data);
    
//    die(var_dump($inscription));
    
  
    $addinscription = new ManagerUser();
    $requete = $addinscription->add($inscription);
 
    header('Location:index.php?action=home');

    exit();
}

function login($email, $mdp, $twig)
{
    $requete = new ManagerUser();
    
    $q=$requete->checklogin($email, $mdp);
    
    header('Location:index.php?action=home');

    exit();
}
    


function addcommentaire($commentaire, $idarticle)
{
    $date = date('d-m-Y H:m');
    $user = $_SESSION['Id'];
    
    $data=[
        'ContentCommentaire' => $commentaire,
        'ArticleidArticle' => $idarticle,
        'CreateDate' => $date,
        'Useriduser' => $user
    ];
    
    $commentaires = new Commentaire($data);

//    die(var_dump($commentaires));
    
    $requete = new ManagerCommentaire();
    
    $requete->add($commentaires);
    
    header('location: ./index.php?action=viewarticle&idarticle='.$idarticle);

    exit();
}

function destroy($twig)
{
    session_destroy();
    
    header('Location:index.php?action=home');

    exit();
}

function validationCommentaire($twig, $idCommentaire, $idarticle)
{
    $requete= new ManagerCommentaire();
    $requete->validationCommentaire($idCommentaire);
    
    header('location: ./index.php?action=viewarticle&idarticle='.$idarticle);
}

function deleteCommentaire($twig, $idCommentaire, $idarticle)
{
    $drop = new ManagerCommentaire();
    $requete = $drop->delete($idCommentaire);
    
    header('location: ./index.php?action=viewarticle&idarticle='.$idarticle);
}

function modifyCommentaire($twig, $idCommentaire, $idarticle)
{
    $requete = new ManagerCommentaire();
    
    $modifcommentaire = $requete->get($idCommentaire);
    
//    die(var_dump($requete));
    
    /////////////////////
    
    $dataArticle = new ArticleManager();
    
    $data=$dataArticle->get($idarticle);
    
    $commentaire = new ManagerCommentaire();
    
    $q = $commentaire->getListCommentaireByArticle($idarticle);
    
    
       
    echo $twig->render('viewarticleModifyCommentaire.twig', array(
        data=>$data,
        commentaire=>$q,
        modifCommentaire=>$modifcommentaire
    ));
    
    /////////////////////
}


function updateCommentaire($commentaire, $idCommentaire, $idarticle)
{
    $data = new ManagerCommentaire;
    
    $requete = $data->updateCommentaire($commentaire, $idCommentaire);
    
    header('location: ./index.php?action=viewarticle&idarticle='.$idarticle);
}
