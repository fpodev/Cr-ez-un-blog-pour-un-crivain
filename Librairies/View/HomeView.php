<?php
 $titre = 'Accueil';
 require 'Librairies/Template/Head.php';
?> 
<body class="homePage">
  <div class="page"> 
    <div class="contenaire">
<?php require 'Librairies/Template/Header.php';
     
 foreach ($billetsList as $billet)  
  {
   if (strlen($billet->contenu()) <= 400)
    {
      $contenu = $billet->contenu();      
    }   
    else
    {
      $debut = substr($billet->contenu(), 0, 400);
      $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
      
      $contenu = $debut;
    }   
        echo '<article class="billetList">
         <h2>', $billet->titre(), '</h2>', "\n";        
         if (date('d/m/y à H:i:s', strtotime($billet->dateAjout())) != date('d/m/y à H:i:s', strtotime($billet->dateModif())))
         {
          echo '<p><em>Modifier le', date('d/m/y à H:i:s', strtotime($billet->dateModif())), '</em></small></p>';
         }
         else
         {
           echo '<p><em>Ajouter le ', date('d/m/y à H:i:s', strtotime($billet->dateAjout())), '</em></small></p>';
         } 
        echo '<p class="contenu">', nl2br($contenu), ' <a href="index.php?billetUnique='.$billet->id(), '">Lire la suite</a></p>
         
          </article>';                   
        } 
?>
      <div class='navBar'>
      <?php if($pageCourante == 1)
            { 
               echo 'page ',$pageCourante,'/', $nbPages , ' <a href="?page=', $pageCourante + 1 , '">suivante</a>';
            }                           
            elseif($pageCourante == $nbPages)
            {
               echo '<a href="?page=', $pageCourante - 1 ,'">précédente</a> page ', $pageCourante,'/', $nbPages ;
            }
            else
            {              
               echo '<a href="?page=', $pageCourante - 1 ,'">précédente</a> page ',  $pageCourante,'/', $nbPages , ' <a href="?page=', $pageCourante + 1 ,'">suivante</a>';
            }        
      echo '</div>
            </div>';  
     require 'Librairies/Template/Footer.php';?>  
      </div>
  </body>      
</html>