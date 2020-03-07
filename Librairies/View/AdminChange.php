<?php 
use App\Model\BilletsManager; 
use App\Objet\Billet;

$titre = 'administration'; 
require 'Librairies/Template/Head.php';

        echo '<h1 class="titreAdmin">Bienvenue sur votre page d\'administration</h1>
              <button class="btnAdmin"><a href="index.php?Accueil">Retour à l\'accueil</a></button>  
              <button class="btnAdmin"><a href="index.php?changePass">Changer votre mot de passe</a></button>
              <div class="formAdmin">  
              <form action="index.php" method="post">
             <p>'
        ?>                                      
               <?php if(isset($erreurs) && in_array(Billet::TITRE_INVALIDE, $erreurs)) echo 'Le titre est invalide.<br />'; ?>
                Titre : <input type="text" name="titre" value="<?php if (isset($billet)) echo $billet->titre(); ?>" /><br />
                
                <?php if (isset($erreurs) && in_array(Billet::CONTENU_INVALIDE, $erreurs)) echo 'Le contenu est invalide.<br />'; ?>
                Contenu :<br /><textarea id="formulaire" type="text" name="contenu"><?php if (isset($billet)) echo $billet->contenu(); ?></textarea><br />
        <?php
        if(isset($billet) && !$billet->isNew())
        {
        ?>
                <input type="hidden" name="id" value="<?= $billet->id() ?>" />
                <input class="btnForm" type="submit" value="Valider" name="postModifier" />
                <input class="btnForm" type="submit" value="Annuler" name="annuler"/> 
                <input class="btnForm" type="submit" value="Supprimer" name="supprimer"/>                      
        <?php
        }
        else
        {
        ?>
                <input class="btnForm" type="submit" name="postBillet" value="Ajouter"/> 
        <?php        
        }         
        echo ' </p>
         </form>
        </div>'        
        
      ?>      
    <script src="https://cdn.tiny.cloud/1/5ya0hoc0tjh102vqr3m520w8306eqxcu8mz71btr0zmc1z2t/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector: '#formulaire'});</script>    
 

   

