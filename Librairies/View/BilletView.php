<?php
$titre = 'Article';
require 'Librairies/Template/Head.php';
?>
<body id="billet"> 
  <div class='page'>
    <div class='contenaire'>
<?php require 'Librairies/Template/Header.php';

 foreach($billetId as $billet):
  echo '<article class=billet>
        <h2>', $billet->titre(), '</h2>', "\n",
        '<p class="contenu">', nl2br($billet->contenu()), '</p>', "\n";
  
  if (date('d/m/y à H:i:s', strtotime($billet->dateAjout())) === date('d/m/y à H:i:s', strtotime($billet->dateModif())))
  {
    echo  '<p class="date"><em>Ajouter le ', date('d/m/y à H:i:s', strtotime($billet->dateAjout())), '</em></small></p>';
  }
  else
  {   
    echo  '<p class="date"><em>Modifiée le ', date('d/m/y à H:i:s', strtotime($billet->dateModif())), '</em></small></p>';
  }
  echo '</article>';
 endforeach; 
?>  
<?php 
  if($commentList == true)
  {
  echo '<p class="comTitre">Commentaire(s)</p>';
  foreach($commentList as $comment): 
     echo'<div class="commentaire">
         <p>De<span class="pseudo"> ' .$comment->pseudo(). ' </span><small><em>le ', date('d/m/y à H:i:s', strtotime($comment->dateAjout())),'</em></small></p>';
         
         if($comment->signaler() === 'signaler')
         {
         echo '<p class="textSignal"><small>Commentaire en cour de modération</small></p>';         
         }
         else
         {
         echo '<p class="textComment">', $comment->contenu(),'</p> 
               <p class="textSignal"><a href="index.php?signalComment=',$comment->id(),'& idBillet=',$billet->id(),'"><small>Signaler ce commentaire</small></a></p>';              
         }
         echo '</div>';                      
        endforeach; 
  }       
?>
      <div class="commentForm">  
        <p> Ajouter un Commentaire</p>
        <form action='index.php' method="post"> 
              
                <label for="pseudo">Pseudo :</label> <br>
                <input type="text" name="pseudo" require /> <br>
              
                <label for="mail">Votre adresse mail :</label> <br>
                <input type="email" name="mail" require />  <br>
              
                <label for="contenu">Votre commentaire :</label> <br>
                <textarea type='text' name="contenu" require ></textarea> <br>

                <input type='hidden' name='id_billet' value='<?=$billet->id()?>'/>                     
                <input type="submit" name="action" value="Envoyer"/>               
        </form> 
      </div>
  </div> 
<?php include 'Librairies/Template/Footer.php';?>  
    </div>         
  </body>  
</html>