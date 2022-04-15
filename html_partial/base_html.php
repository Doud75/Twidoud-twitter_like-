<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="titre"><?=$title?></title>
    <link rel="stylesheet" type="text/css" href="style/style.css?<?php echo time();?>">
</head>
<body>
    <header>
        <nav id="nav">
            <img id="logo" src="img/Union.png" >
            <h1 id="site_name" >Twettic</h1>
        </nav>
    </header>
    
    <?= $content ?>

    <footer>
    </footer>
</body>
</html>