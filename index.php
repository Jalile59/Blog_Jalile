<?php 
// Definition du path absolu
 session_start();
define("ABSOLUTE_PATH", dirname(__FILE__));

require ABSOLUTE_PATH. '/vendor/autoload.php';
require ABSOLUTE_PATH. '/controleur/controleur.php';

spl_autoload_register('custom_autoloader');
function custom_autoloader($className)
{
    $path      = ABSOLUTE_PATH .'/model/';
    $filename  = $path .$className . '.php';
    if (file_exists($filename)) {
        require_once $filename;
    }
}


$loader = new Twig_Loader_Filesystem('templates');

$twig = new Twig_Environment($loader, [
    'cache' => false,
    'debug'=>true
]);

$twig->addExtension(new Twig_Extension_Debug);

//die(var_dump($_SESSION));

$twig->addGlobal('session', $_SESSION);

//$container->loadFromExtension('twig', array('global'=>$_SESSION));


if (isset($_GET['action'])) {
    if (htmlspecialchars($_GET['action'])== 'article') {
        $list = getListArticle($twig);
    } elseif ($_GET['action'] == 'ViewAddarticle') {
        echo $twig->render('newArticle.twig'); // WPCS: XSS OK
    } elseif ($_GET['action']=='AddArticle') {
        $add = addarticle(htmlspecialchars($_POST['inputArticleTitre']), htmlspecialchars($_POST['inputArticleGatégorie']), $_POST['inputArticleContent'], htmlspecialchars($_POST['inputChapo']), htmlspecialchars($_POST['inputArticleAuteur']));
    } elseif ($_GET['action']=='viewarticle') {
        viewArticle($twig, htmlspecialchars($_GET['idarticle']));
    } elseif ($_GET['action']=='dropArticle') {
        $drop = dropArticle(htmlspecialchars($_GET['id']));
    } elseif ($_GET['action']=='ViewModify') {
        $viewModify = viewModifyArticle($twig, $_GET['Articleid']);
    } elseif ($_GET['action']=='UpdateArticle') {
        $up = updateArticle(htmlspecialchars($_POST['inputArticleTitre']), htmlspecialchars($_POST['inputArticleGatégorie']), htmlspecialchars($_POST['inputArticleTitre']), $_POST['inputArticleContent'], $_POST['inputChapo'], htmlspecialchars($_POST['inputArticleAuteur']), htmlspecialchars($_GET['Articleid']));
    } elseif ($_GET['action']=='Inscription') {
        callInscription($twig);
    } elseif ($_GET['action']=='AddInscription') {
        $addinscrip = addinscription(htmlspecialchars($_POST['Name']),htmlspecialchars($_POST['Surename']), htmlspecialchars($_POST['Pseudo']), htmlspecialchars($_POST['Mail']), htmlspecialchars($_POST['Psw']));
    } elseif ($_GET['action']=='connect') {
        callConnect($twig);
    } elseif ($_GET['action']=='login') {
        login(htmlspecialchars($_POST['email']),htmlspecialchars( $_POST['password']), $twig);
    } elseif ($_GET['action']=='addcommentaire') {
        $requete = addcommentaire($_POST['commentaire'], $_GET['idarticle']);
    } elseif ($_GET['action']=='destroy') {
        $requete = destroy($twig);
    } elseif ($_GET['action']=='home') {
        echo $twig->render('home.twig'); // WPCS: XSS OK
    } elseif ($_GET['action']== 'valideCommentaire') {
        $requete = validationCommentaire($twig, $_GET['idCommentaire'], $_GET['idarticle']);
    } elseif ($_GET['action']=='suppCommentaire') {
        $requete = deleteCommentaire($twig, $_GET['idCommentaire'], $_GET['idarticle'], $_GET['idarticle']);
    } elseif ($_GET['action']=='modifyCommentaire') {
        $requete = modifyCommentaire($twig, $_GET['idCommentaire'], $_GET['idarticle']);
    } elseif ($_GET['action']=='upComentaire') {
        
//        echo $_POST['commentaire'], $_GET['idCommentaire'], $_GET['idarticle'];
//        die;
        $requete = updateCommentaire($_POST['commentaire'], $_GET['idCommentaire'], $_GET['idarticle']);
    }
} else {
    echo $twig->render('home.twig'); // WPCS: XSS OK
}
