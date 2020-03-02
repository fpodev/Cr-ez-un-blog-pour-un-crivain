<?php
$titre = 'administration'; 
require 'Librairies/Template/Head.php';

ob_start();
        echo '<h1 class="titreAdmin">Bienvenue sur votre page d\'administration</h1>
              <button class="btnAdmin"><a href="index.php?Accueil">Retour à l\'accueil</a></button>  
              <div class="formAdmin">  
              <form action="index.php" method="post">
             <p>'
        ?>                                      
               <?php if(isset($erreurs) && in_array(Billets::TITRE_INVALIDE, $erreurs)) echo 'Le titre est invalide.<br />'; ?>
                Titre : <input type="text" name="titre" value="<?php if (isset($billet)) echo $billet->titre(); ?>" /><br />
                
                <?php if (isset($erreurs) && in_array(Billets::CONTENU_INVALIDE, $erreurs)) echo 'Le contenu est invalide.<br />'; ?>
                Contenu :<br /><textarea id="formulaire" type="text" name="contenu"><?php if (isset($billet)) echo $billet->contenu(); ?></textarea><br />
        <?php
        if(isset($billet) && !$billet->isNew())
        {
        ?>
                <input type="hidden" name="id" value="<?= $billet->id() ?>" />
                <input class="btnForm" type="submit" value="Modifier" name="postModifier" />
                <input class="btnForm" type="submit" value="Annuler" name="annuler"/>        
        <?php
        } 
       
        echo ' </p>
         </form>
        </div>';
$contenu = ob_get_contents();  
require 'Librairies/Template/admin.php';      
?>

