<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php ob_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Demande de congée</title>
    </head>
    <body>
        <p>
            Bonjour, <br>
            vous avez reçu un message depuis le le BlogJalile.
            
        </p>
    
        <ul>
            <li>Nom: <?php echo $nom ?> </li>
            <li>Email:<?php echo $mail ?> </li>
            <li>Téléphone: <?php echo $numerotel ?></li>
        </ul>
        
        <a>Message:</a>
        <p><?php $message ?></p>
        </table>
    </body>
</html>
<?php $contenu = ob_get_clean(); ?>
