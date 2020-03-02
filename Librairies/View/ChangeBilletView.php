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
        <?php
        if (isset($message))
        {
          echo $message, '<br />';
        }
                
        foreach($billetUnique as $billets):
                
                if(isset($erreurs) && in_array(Billets::TITRE_INVALIDE, $erreurs)) echo 'Le titre est invalide.<br />'; ?>
                Titre : <input type="text" name="titre" value="<?php if (isset($billets)) echo $billets->titre(); ?>" /><br />
                
                <?php if (isset($erreurs) && in_array(Billets::CONTENU_INVALIDE, $erreurs)) echo 'Le contenu est invalide.<br />'; ?>
                Contenu :<br /><textarea id="formulaire" type="text" name="contenu"><?php if (isset($billets)) echo $billets->contenu(); ?></textarea><br />
        <?php
        if(isset($billets) && !$billets->isNew())
        {
        ?>
                <input type="hidden" name="id" value="<?= $billets->id() ?>" />
                <input class="btnForm" type="submit" value="Modifier" name="postModifier" />
                <input class="btnForm" type="submit" value="Annuler" name="annuler"/>        
        <?php
        }
        endforeach;
        echo ' </p>
         </form>
        </div>';
$contenu = ob_get_contents();  
require 'Librairies/Template/admin.php';      
?>

