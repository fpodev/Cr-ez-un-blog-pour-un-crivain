<?php
$titre = 'administration'; 
require 'Librairies/Template/Head.php';
?>
<body>
<?php
        echo '<h1 class="titreAdmin">Bienvenue sur votre page d\'administration</h1>
              <button class="btnAdmin"><a href="index.php?Accueil">Retour à l\'accueil</a></button>  
              <button class="btnAdmin"><a href="index.php?changePass">Changer votre mot de passe</a></button>
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
        else
        {
        ?>
                <input class="btnForm" type="submit" name="postBillet" value="Ajouter"/> 
        <?php        
        }         
        echo ' </p>
         </form>
        </div>
        
        <p class="listeAdmin">Il y a actuellement '. $billetCount .' billets. En voici la liste :</p>

        <table>
            <tr><th>Titre</th><th>Date d\'ajout</th><th>Dernière modification</th><th>Action</th></tr>';
   
    foreach($billetList as $billets){
            $date1 = date('d/m/y à H:i:s', strtotime($billets->dateAjout()));
            $date2 = date('d/m/y à H:i:s', strtotime($billets->dateModif()));      
            echo '<tr><td>',$billets->titre(), '</td><td>', $date1, '</td><td>', ($date1 == $date2 ? '-' : $date2),
                '</td><td><button class="btnModif"><a href="index.php?modifierBillet='. $billets->id(),  '">Modifier</a></button> | <button class="delete"><a href="index.php?supprimerBillet='. $billets->id(), '">Supprimer</a></button></td></tr>', "\n";
        }             
?>   
    </table> 

        <p class="listeAdmin">Liste des commentaires signalés:</p>

    <table class='listeCom'>    
    <tr><th>Id_Billet</th><th>Pseudo</th><th>Mail</th><th>Contenu</th><th>Action</th></tr>
<?php
    foreach($signalList as $comment){               
            echo '<tr><td><button><a href="index.php?modifierBillet='. $comment->id_billet(), '"</a>'. $comment->id_billet().'</button></td><td>', $comment->pseudo(), '</td><td>', $comment->mail(),
                '</td><td>',$comment->contenu(),'</td><td><button class="valide"><a href="index.php?validerComment='. $comment->id(),  '">Valider</a></button> |<button class="delete"><a href="index.php?deleteComment='. $comment->id(), '">Supprimer</a></button></td></tr>', "\n";
        }            
?>   
    </table>  
    <script src="https://cdn.tiny.cloud/1/5ya0hoc0tjh102vqr3m520w8306eqxcu8mz71btr0zmc1z2t/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector: '#formulaire'});</script>                  
</body>
</html>


