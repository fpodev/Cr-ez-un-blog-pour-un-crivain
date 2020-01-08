<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">   
    <title>Administration blog</title>
    <link rel="stylesheet" href="style/admin.css" media="all">     
</head>
<body>
    <h1 class="title">Espace administration</h1>
    <h2 class="view">Ecrire nouvel article</h2>
    <form class="text" method="post" action="controler.php">
      <textarea id="mytextarea">Hello, World!</textarea>
      <button type="submit">Poster</button>
    </form>   
    <h2 class="diffuser">Articles postés</h2> 
    <h2 class="bad">Commentaires signalés</h2>
    <h2 class="commentaire">Derniers commentaires</h2>   
</body>
<script src="https://cdn.tiny.cloud/1/5ya0hoc0tjh102vqr3m520w8306eqxcu8mz71btr0zmc1z2t/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>tinymce.init({ selector: '#mytextarea'});</script>
</html>