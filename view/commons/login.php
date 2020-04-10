<?php $title = 'Se connecter'; ?>

<?php ob_start(); ?>

            <p><br><br><br><br></p>
            <div class="box w50">
                <div class="head_box">
                   <span class="labhead">Login Form</span>
                </div>
                <div class="body_box">
                    <form action="index.php?origin=login" method="post">
                        <div class="div_input"><input class="iptxt iplogin" type="text" name="username" placeholder="     Login" required></div>
                        <div class="div_input "><input class="iptxt ippwd" type="password" name="password" placeholder="     Password" required></div>
                        <div class="div_input"><input class="ipbtn" type="submit" name="connexion" value="Connexion">&nbsp;&nbsp;&nbsp;<a href="inscription.php"><small>s'inscrire pour jouer</small></a></div>
                    </form>
                </div>
            </div>
            
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>