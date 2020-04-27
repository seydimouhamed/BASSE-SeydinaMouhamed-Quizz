<?php ob_start(); ?>
       <link rel="stylesheet" type="text/css" href="public/css/homeAdmin.css">
       <link rel="stylesheet" type="text/css" href="public/css/styleCheck.css">
       <link rel="stylesheet" type="text/css" href="public/css/styleCheckAdmin.css">
        
    <div class="body_box">
        <div class="box_menu_1">
            <div class="div_avatar_1">
                <div class="img_avatar_1">
                    <img class="w_70_h_70" alt="av" src="public/imageUsers/<?php if(isset($userInfo['avatar'])){echo $userInfo['avatar'];}else{ echo "default.jpg";}?>"/>
                </div>
                <div class="float_l ">
                    <br><br>
                    <div>&nbsp;&nbsp;&nbsp;<label class="lab_prenom "><?= $userInfo['firstname'];?></label></div>
                    <div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="lab_nom"><?=$userInfo['lastname'];?></label></div>
                </div>
            </div>
            <div class="div_menu"> 
                <a href="index.php?origin=admin&action=listQuestion"><div class="li <?php $act="active"; if($p=="listQuestion") {echo $act;}?>" id="sm_1"><span>Liste Questions</span></div></a>
                <a href="index.php?origin=admin&action=createAdmin"><div class="li <?php if($p=="createAdmin") {echo $act;}?> " id="sm_2">Créer Admin</div></a>
                <a href="index.php?origin=admin&action=joueurs"><div class="li <?php if($p=="joueurs") {echo $act;}?>" id="sm_3">Liste joueurs</div></a>
                <a href="index.php?origin=admin&action=createQuestion1"> <div class="li  <?php if($p=="createQuestion1") {echo $act;}?>" id="sm_4">Créer Questions</div></a>
            </div>
        </div>

        <div class="rotate_page">
                <?= $content_admin ?>
        </div>
    </div>
<?php $content_container = ob_get_clean(); ?>

<?php require("view/commons/template_container.php"); ?>