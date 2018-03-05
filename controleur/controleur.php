<?php
require './model/ManagerArticle.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function callInscription($twig)
{   
    $nom =$_SESSION['Nom'];
    
    if ($nom) {
        echo $twig->render('home.twig'); // WPCS: XSS OK
    } else {
        echo $twig->render('inscription.twig'); // WPCS: XSS OK
    }
}

function callConnect($twig)
{
    $nom =$_SESSION['Nom'];
    
    if ($nom) {
        echo $twig->render('home.twig');    // WPCS: XSS OK
    } else {
        echo $twig->render('connection.twig');  // WPCS: XSS OK
    }
}

///////////////////////////////////////////////////////////////////////////////

function addarticle($namearticle, $categorie, $content, $chapo, $auteur, $twig)
{   
    $error = checkformArticle($namearticle, $content, $chapo, $auteur);
   
    if ($error['namearticle']== 1 or $error['content']== 1 or $error['auteur']==1 or $error['chapo']==1){
        
        echo $twig->render('newArticle.twig', array(data=>$error)); // WPCS: XSS OK
        
    }else{
    
    $user_iduser= $_SESSION['Id'];
    
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
        
        if ($CheckFile) {
        } else {
        }
        
        $manager = new ArticleManager();

        $manager->addArticle($article);
        
        header('Location: index.php?action=article');
        
    }
    }


function getListArticle($twig)
{
    $listeArticle = new ArticleManager();
    
    $data= $listeArticle->getListArticle();
        
    
 
    
    
    echo   $twig->render('article.twig', array(data =>$data));  // WPCS: XSS OK
}

function viewArticle($twig, $idarticle)
{
    $dataArticle = new ArticleManager();
    
    $data=$dataArticle->get($idarticle);
    
    $commentaire = new ManagerCommentaire();
    
    $q = $commentaire->getListCommentaireByArticle($idarticle);
    
    
    
    echo $twig->render('viewarticle.twig', array(data=>$data,   // WPCS: XSS OK                 
                                                commentaire=>$q
                                               ));
}

function dropArticle($idarticle)
{
    $drop = new ArticleManager();
    $requete = $drop->delete($idarticle);
    
    if ($requete) {
        header('Location: index.php?action=article');
        
    } else {
        echo 'erreur lors de la suppression de l article';
    }
}

function updateArticle($namearticle, $categorie, $content, $chapo, $auteur, $idarticle)
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
        'idArticle'=>$idarticle,
        'dateModificationArticle'=> $date
    ];
    
    
    
    $article = new Article($data);
    
    $article->checkDirphoto($_FILE);
    
    $uparticle= new ArticleManager();
    
    
    $uparticle->update($article);
    
    header('Location: index.php?action=article');
}

function viewModifyArticle($twig, $id)
{
    $dataArticle = new ArticleManager();
    
    $data=$dataArticle->get($id);
    

    
    
    
    echo $twig->render('modifyArticle.twig', array(data=>$data));   // WPCS: XSS OK
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
        
  
    $addinscription = new ManagerUser();
    $addinscription->add($inscription);
 
    header('Location:index.php?action=home');

}

function login($email, $mdp, $twig)
{
    
    $error = checkfromlogin($email, $mdp);
    
    if ($error['mdp'] == 1 or $error['mdp'] == 1 ){
        
        echo $twig->render('connection.twig', array('data'=> $error));  // WPCS: XSS OK

    }
    
  
    
    $requete = new ManagerUser();
    
    $requete->checklogin($email, $mdp);

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

    
    $requete = new ManagerCommentaire();
    
    $requete->add($commentaires);
    
    header('location: ./index.php?action=viewarticle&idarticle='.$idarticle);

    exit();
}

function destroy()
{
    session_destroy();
    
    header('Location:index.php?action=home');

    exit();
}

function validationCommentaire($idCommentaire, $idarticle, $redirection)
{
    $requete= new ManagerCommentaire();
    $data =$requete->validationCommentaire($idCommentaire);
    
        if ($redirection = 'listingcom'){
        
        header('location: ./index.php?action=listingCom');
    
        
    } else {
        
        header('location: ./index.php?action=viewarticle&idarticle='.$idarticle);

    }
    
}

function deleteCommentaire($idCommentaire, $idarticle, $redirection)
{
    $drop = new ManagerCommentaire();
    
    $drop->delete($idCommentaire);
    
    
    
    if ($redirection = 'listingcom'){
        
    header('location: ./index.php?action=listingCom');
    
        
    }else{
    
    header('location: ./index.php?action=viewarticle&idarticle='.$idarticle);
}

}

function modifyCommentaire($twig, $idCommentaire, $idarticle)
{
    $requete = new ManagerCommentaire();
    
    $modifcommentaire = $requete->get($idCommentaire);
    
     
    $dataArticle = new ArticleManager();
    
    $data=$dataArticle->get($idarticle);
    
    $commentaire = new ManagerCommentaire();
    
    $q = $commentaire->getListCommentaireByArticle($idarticle);
    
    
       
    echo $twig->render('viewarticleModifyCommentaire.twig', array(  // WPCS: XSS OK
        data=>$data,
        commentaire=>$q,
        modifCommentaire=>$modifcommentaire
    ));
}


function updateCommentaire($commentaire, $idCommentaire, $idarticle)
{
    $data = new ManagerCommentaire;
    
    $data->updateCommentaire($commentaire, $idCommentaire);
    
    header('location: ./index.php?action=viewarticle&idarticle='.$idarticle);
}

function checkfromlogin($mail, $mdp)
{   
    
    
    if($mail){
        $error ['mail'] = 0;
    }else{
        $error ['mail'] = 1;
    }
    
    if($mdp){
        $error ['mdp'] = 0;
    }else{
        $error ['mdp'] = 1;
    }
    
    
    
    return $error;
}

function checkformArticle($namearticle, $content, $chapo, $auteur){
    
    
    if($namearticle){
        $error ['namearticle'] = 0; 
    }else{
        $error ['namearticle'] = 1;
    }

    if($content){
        $error ['content'] = 0;
    }else{
        $error ['content'] = 1;
    }

    if($chapo){
        $error ['chapo'] = 0;
    }else{
        $error ['chapo'] = 1;
    }
    
    if($auteur){
        $error ['auteur'] = 0;
    }else{
        $error ['auteur'] = 1;
    }
    return $error;
}

function sendmail($nom, $mail, $numerotel, $message){
    
//    echo $nom, $mail, $numerotel, $message;
//    die;
    require './templates/mail.php';
    
    mailcontact($contenu);
    
    header('Location:index.php?action=home');

    
    
}

function mailcontact ($contenu){
    
    
    $mail =  new PHPMailer\PHPMailer\PHPMailer(TRUE);   
    try {
        
      //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.free.fr';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'jalile59@free.fr';                 // SMTP username
    $mail->Password = 'Nasseria59';                           // SMTP password
   $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setLanguage('fr', '.\vendor\phpmailer\phpmailer\language');
    $mail->setFrom('jalile59@free.fr', 'BlogJalile');
    $mail->addAddress('jal.djellouli@gmail.com', 'Jalile');     // Add a recipient
   // $mail->addAddress('nas.s@hotmail.fr');               // Name is optional
    //$mail->addReplyTo('jalile59@free.fr', 'Information');
    //$mail->addCC('');
    //$mail->addBCC('');

    //Attachmentsc
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'BlogJalile';
    $mail->Body    = $contenu;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
   // echo 'Mailer Error: ' . $mail->ErrorInfo;
}

}

function adminCom($twig){
    
    $commentaire = new ManagerCommentaire();
    
    $data = $commentaire->getallcommentaire();
    
//    die(var_dump($data));
    
    echo $twig->render('listingCommentary.twig',array(data=>$data));
    
}

function adminPost($twig){
    
    $post = new ArticleManager();
    
    $data = $post->getListArticle();
    
//    die(var_dump($data));
    
    echo $twig->render('listingPost.twig', array(data=>$data));
    
}
