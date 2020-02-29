<?php
use App\Model\LoginManager;

$titre = 'Page Connexion';
require 'Librairies/Template/Head.php';
?>
<body id="loginPage">        
 <p>page de connexion</p>
    <div class='login'>
        <form action="index.php?login" method="post">
            <p>
            <label for="identifiant">Identifiant:</label></br>
            <input type="text" name='identifiant'/></br>
            <label for="pass">Mot de passe:</label></br>
            <input type="password" name="pass" /></br>
            <input type="submit" name="connecter" value="Se connecter" />
            </p>
        </form>
    </div>      
        <p>Espace réserver</p> 
        <a href="index.php">Retour à l'accueil</a>       
</body>
</html>