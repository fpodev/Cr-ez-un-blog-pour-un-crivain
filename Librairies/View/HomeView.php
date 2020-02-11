<?php
use App\Model\BilletsManager;
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>administration</title>  
    <link rel="stylesheet" type="text/css" href="style/admin.css">
  </head>
  
  <body>
    <p><a href="<?="index.php?action=admin"?>">Accéder à l'espace d'administration</a></p>
<?php
  echo '<h2 style="text-align:center">Liste des 5 dernières news</h2>';

 foreach ($billetList as $billet)  
  {
    if (strlen($billet->contenu()) <= 200)
    {
      $contenu = $billet->contenu();      
    }   
    else
    {
      $debut = substr($billet->contenu(), 0, 200);
      $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
      
      $contenu = $debut;
    }  
    echo '<h4><a href="index.php?id='.$billet->id(), '">', $billet->titre(), '</a></h4>', "\n",
         '<p>', nl2br($contenu), '</p>';
         if (date('d/m/y à H:i:s', strtotime($billet->dateAjout())) != date('d/m/y à H:i:s', strtotime($billet->dateModif())))
         {
          echo '<p><em>Modifier le', date('d/m/y à H:i:s', strtotime($billet->dateModif())), '</em></small></p>';
         }
         else
         {
           echo '<p><em>Ajouter le ', date('d/m/y à H:i:s', strtotime($billet->dateAjout())), '</em></small></p>';
         }         
 }
  
?>
  </body>
</html>