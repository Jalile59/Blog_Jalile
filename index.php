<?php 
// Definition du path absolu
 session_start (); 
define("ABSOLUTE_PATH", dirname(__FILE__));

require ABSOLUTE_PATH. '/vendor/autoload.php';
require ABSOLUTE_PATH. '/controleur/controleur.php';

spl_autoload_register( 'custom_autoloader' );
function custom_autoloader($className) {
    $path      = ABSOLUTE_PATH .'/model/';
    $filename  = $path .$className . '.php';
    if ( file_exists($filename) ) {
        require_once $filename;
    }
}


$loader = new Twig_Loader_Filesystem('templates');

$twig = new Twig_Environment ($loader, [
    'cache' => FALSE,
    'debug'=>TRUE
]);

$twig->addExtension(new Twig_Extension_Debug);

//$container->loadFromExtension('twig', array('global'=>$_SESSION));


if (isset($_GET['action'])){
    
     if ($_GET['action']== 'article'){
        
        //$call = callHome();
        $list = getListArticle($twig);

        
    }elseif ($_GET['action'] == 'ViewAddarticle') {
        
        //$call = callAddArticle();

        echo $twig->render('newArticle.twig');
        
    }elseif ($_GET['action']=='AddArticle') {
        
        
        $add = AddArticle($_POST['inputArticleTitre'], $_POST['inputArticleGatégorie'], $_POST['inputArticleTitre'], $_POST['inputArticleContent']);
        
    }elseif ($_GET['action']=='viewarticle') {
        
        viewArticle($twig, $_GET['idarticle']);
        
    }elseif ($_GET['action']=='dropArticle') {
        
        $drop = dropArticle($_GET['id']);
        
    }elseif ($_GET['action']=='ViewModify') {
        
       $viewModify = viewModifyArticle($twig, $_GET['Articleid']); 
        
    }elseif ($_GET['action']=='UpdateArticle') {
        
        $up = updateArticle($_POST['inputArticleTitre'], $_POST['inputArticleGatégorie'], $Dirphoto, $_POST['inputArticleContent'], $_GET['Articleid']);
        
    }elseif ($_GET['action']=='Inscription') {
        
        callInscription($twig);
    }elseif($_GET['action']=='AddInscription'){
        

        $addinscrip = addinscription($_POST['Name'], $_POST['Surename'], $_POST['Pseudo'], $_POST['Mail'], $_POST['Psw']);
        
    }elseif($_GET['action']=='connect'){
        
        callConnect($twig);
    }elseif($_GET['action']=='login'){
        
        login($_POST['email'], $_POST['password'], $twig);
        
    }elseif ($_GET['action']=='addcommentaire') {
        
        
//        die($_POST['commentaire']);
        $requete = addcommentaire($_POST['commentaire'], $_GET['idarticle']);
    }
    
    
}else{
    
  
    echo $twig->render('home.twig');
    
    
    
}
