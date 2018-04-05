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
            Bienvenue sur notre "blog_Jalile", je vous confirmons l'inscription sur le blog.
            
            <br>
            cordialement Mr Djellouli.
        </p>        
    </body>
</html>
<?php $contenu = ob_get_clean(); ?>
