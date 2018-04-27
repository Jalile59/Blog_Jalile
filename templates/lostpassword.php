

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

<?php ob_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Demande de congée</title>
    </head>
    <body>
        <p>
            Bonjour, <br>
            Suite à votre demande de mot de passe:
            
        </p>
    
        <ul>
            <li>Email: <?php echo htmlspecialchars($mail) // WPCS: XSS OK?> </li>
            <li>Mot de passe:<?php echo htmlspecialchars($password) // WPCS: XSS OK?> </li>
        </ul>
        

    </body>
</html>
<?php $contenu = ob_get_clean(); ?>