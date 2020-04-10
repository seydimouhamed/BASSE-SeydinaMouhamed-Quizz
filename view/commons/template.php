<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    </head>
        
    <body>
        <div class="transparent">
        <header>
            <nav>
                <div class="logo"><img class="img_h100" alt='logo' src="public/images/logo-QuizzSA.png"></div>
                <div class="titre">Le plaisir de jouer</div>
            </nav>
        </header>
        <?= $content ?>
        <div>
    </body>
</html>