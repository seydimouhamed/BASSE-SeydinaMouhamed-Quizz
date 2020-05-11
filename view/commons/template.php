<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link rel="stylesheet" type="text/css" href="public/css/style.css">
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    </head>
        <script type="text/javascript">

     window.onload = function() {
            setTimeout(function(){ 
                    document.getElementById("alert").style.display='none';
                }, 3000);
            }
        </script>
    <body>
        <div class="transparent">
        <header>
            <nav>
                <div class="logo"></div>
                <div class="titre">Le plaisir de jouer</div>
            </nav>
            <?php
                
                if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
                {
                    $msg=$_SESSION['msg'];
                    $_SESSION['msg']=array();
                    foreach($msg as $m)
                    {
            ?>
                    <div id="alert" class="msg <?= $m['type']?>">
                        <span class="closebtn"  onclick="this.parentElement.style.display='none';">&times;</span> 
                        <strong><?= $m['type']?></strong> <?= $m['text']?>
                    </div>
            <?php 
                    }
                }
             ?>
        </header>
        <?= $content ?>
        <div>
    </body>
</html>