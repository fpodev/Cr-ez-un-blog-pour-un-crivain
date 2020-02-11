<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Billet</title>  
    <link rel="stylesheet" type="text/css" href="style/admin.css">
  </head>  
  <body>
  <p><a href="index.php">Accueil</a></p>
<?php
 foreach($billetId as $billet):
  echo '<h2>', $billet->titre(), '</h2>', "\n",
       '<p>', nl2br($billet->contenu()), '</p>', "\n";
  
  if (date('d/m/y à H:i:s', strtotime($billet->dateAjout())) === date('d/m/y à H:i:s', strtotime($billet->dateModif())))
  {
    echo  '<p><em>Ajouter le ', date('d/m/y à H:i:s', strtotime($billet->dateAjout())), '</em></small></p>';
  }
  else
  {   
    echo  '<p><em>Modifiée le ', date('d/m/y à H:i:s', strtotime($billet->dateModif())), '</em></small></p>';
  }
 endforeach;
?>
<?php 
  foreach($commentList as $comment): 
    echo //'<p>', $comment->count(),'</p><',
         '<p>', $comment->pseudo(),'</p>',
         '<p><em>', date('d/m/y à H:i:s', strtotime($comment->dateAjout())),'</em></small></p>',
         '<p>', $comment->contenu(),'</p>';
         if($comment->signaler() === 'signaler')
         {
         echo '<p>Commentaire en cour de modération</p>';         
         }
         else
         {
         echo '<p><a href="index.php?signal=',$comment->id(),'">Signaler ce commentaire</a></p>'; 
             
         } 
        echo '<p>---------------------------------------------------------------------------------</p>';               
         

        endforeach; 
?>  
<?php  
if (isset($message))
{
  echo $message, '<br />';
} 
?>
<form action='index.php' method="post"> 
       
        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo" require /> 
       
        <label for="mail">Votre adresse mail :</label>
        <input type="email" name="mail" require />
       
        <label for="contenu">Votre commentaire :</label>
        <textarea type='text' name="contenu" require ></textarea> 

        <input type='hidden' name='id_billet' value='<?=$billet->id()?>'/>                     
        <input type="submit" name="action" value="Envoyer"/>   
        </form>  
        <?= require_once('Librairies/Template/Footer.php')?>            
  </body>  
</html>