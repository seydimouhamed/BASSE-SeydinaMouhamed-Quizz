<?php ob_start(); ?>
    <div class="container">
        <div class="box w92">
            <div class="head_box">
                <?php if($userInfo['type']=="user") { ?>
                    <div class="div_avatar">
                            <img class="w_70_h_70 img_avatar" alt="av" src="public/imageUsers/<?php if(isset($userInfo['avatar'])){echo $userInfo['avatar'];}else{ echo "default.jpg";}?>"/>
                    </div>
                    <div class="name_user">
                        <?='  '.$userInfo['firstname'].' '.$userInfo['lastname']?>
                    </div>
                <?php }?>
                <p><?=$subtitle ?></p>
                <a href="index.php?origin=deconnexion">
                    <button class="ipbtn pos_abs float_r">Déconnexion</button>
                </a>
            </div>
            <?= $content_container ?>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>