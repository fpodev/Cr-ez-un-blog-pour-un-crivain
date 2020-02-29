<?php
use App\Model\LoginManager;

$titre = 'Page Connexion';
require 'Librairies/Template/Head.php';
?>
<body id="loginPage">        
 <p>Changement de mot de passe</p>
    <div class='login'>
        <form action="index.php?modifPass" method="post">
            <p>
            <label for="ancienPass">Ancien mot de pass:</label></br>
            <input type="password" name='pass1'/></br>
            <label for="nouveauPass">Nouveau mot de passe:</label></br>
            <input type="password" name="pass2" /></br>
            <label for="confirmerPass">confirmer nouveau mot de passe:</label></br>
            <input type="password" name="pass3" /></br>
            <input type="submit" name="changePass" value="Changer mot de passe" />
            </p>
        </form>
    </div>             
        <a href="index.php">Retour à l'accueil</a>       
</body>
</html>