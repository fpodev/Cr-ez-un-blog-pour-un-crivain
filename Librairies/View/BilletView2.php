<?php 
   
  foreach($commentList as $comment){   
    echo //'<p>', $comment->count(),'</p><',
         '<p>', $comment->pseudo(),'</p>',
         '<p><em>', date('d/m/y à H:i:s', strtotime($comment->dateAjout())),'</em></small></p>',
         '<p>', $comment->contenu(),'</p>',
         '<p><a href="index.php?action=signaler">Signaler ce commentaire</a></p>';  
        };
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