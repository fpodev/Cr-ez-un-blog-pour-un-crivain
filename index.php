<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Billet simple pour l'Alaska</title> 
    <link rel="stylesheet" href="style/style.css" media="all">  
</head>
<body>
    <section id="menu">
        <h1>BILLET SIMPLE POUR L'ALASKA</h1>
    </section>
    <section id="articles">
        <div>
        <article class="post"></article>
        </div>
        <div id="lastComment">
            <h2>Vos commentaire!</h2>
            <p class="comment"></p>
        </div>
        <form id="userComment" method="post" action="controler.php">
            <label for="pseudo">Nom :</label>
            <input type="text" name="pseudo" id="pseudo"/>
            <label for="mail">Votre Email :</label> 
            <input type="email" name="email" id="email"/>
            <label for="avis">Ajouter un commentaire :</label>
            <textarea name="text" id="avis" ></textarea>
            <input type="submit" name="envoyer" id="envoyer" value="envoyer"/>
        </form>       
    </section>
    <section id="footer">
        <a href="admin.php">test</a>
    </section>    
</body>
</html>
