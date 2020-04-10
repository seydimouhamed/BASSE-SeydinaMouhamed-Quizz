       <link rel="stylesheet" type="text/css" href="public/css/homeadmin.css">
        <link rel="stylesheet" type="text/css" href="public/css/styleInscription.css">

        <header>
            <nav>
                <div class="logo"><img class="img_h100" alt='logo' src="public/images/logo-QuizzSA.png"></div>
                <div class="titre">Le plaisir de jouer</div>
            </nav>
        </header>
        <div class="container">
            <div class="box w92">
                <div class="head_box">
                   <h2 flo>Créer et paramétrer vos quizz</h2>
                   <a href="index.php?origin=deconnexion"><button class="ipbtn pos_abs float_r">Déconnexion</button></a>
                </div>
                <div class="body_box">
                    <div class="box_menu">
                        <div class="div_avatar">
                            <div class="img_avatar">
                                <img class="w_70_h_70" alt="av" src="public/imageUsers/<?php if(isset($userInfo['avatar'])){echo $userInfo['avatar'];}else{ echo "default.jpg";}?>"/>
                            </div>
                            <div class="float_l ">
                                <br><br>
                                <div>&nbsp;&nbsp;&nbsp;<label class="lab_prenom "><?= $userInfo['firstname'];?></label></div>
                                <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="lab_nom"><?=$userInfo['lastname'];?></label></div>
                            </div>
                        </div>
                        <div class="div_menu"> 
                            <a href="index.php?origin=admin&action=lq"><div class="li <?php if($cp=="lq") {echo "active";}?>" id="sm_1"><span>Liste Questions</span></div></a>
                            <a href="index.php?origin=admin&action=ca"><div class="li <?php if($cp=="ca") {echo "active";}?> " id="sm_2">Créer Admin</div></a>
                            <a href="index.php?origin=admin&action=lj"><div class="li <?php if($cp=="lj") {echo "active";}?>" id="sm_3">Liste joueurs</div></a>
                            <a href="index.php?origin=admin&action=cq"> <div class="li  <?php if($cp=="cq") {echo "active";}?>" id="sm_4">Créer Questions</div></a>
                        </div>
                    </div>

                    <div class="rotate_page">
                         <?= $content ?>
                    </div>
                </div>
            </div>
        </div>