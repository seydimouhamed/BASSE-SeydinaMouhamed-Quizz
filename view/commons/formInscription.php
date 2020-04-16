<link rel="stylesheet" type="text/css" href="public/css/styleInscription.css">      
<div class="div1_1">
                <div class="div2_1">
            <div class="box_left_1">
                <div class="width_90_1">
                    <span class="h2">s'inscrire</span><br>
                    <small><?=$msg_txt ?> </small>
                    <hr/>
                    <form action="controller.php" method="post" enctype="multipart/form-data">
                        <small for="fisrtname">Prénom</small>
                        <div class="div_input_1"><input class="iptxt_1 iplogin_1" type="text" name="firstname" /></div>
                        <small for="lastname">Nom</small>
                        <div class="div_input_1 "><input class="iptxt_1 ippwd_1" type="text" name="lastname" /></div>
                        <small for="lastname">Login</small>
                        <div class="div_input_1 "><input class="iptxt_1 ippwd_1" type="text" name="login" autocomplete="false" /></div>
                        <small for="lastname">Password</small>
                        <div class="div_input_1 "><input class="iptxt_1 ippwd_1" type="password" name="pwd" autocomplete="false"/></div>
                        <small for="lastname">Confirm password</small>
                        <div class="div_input_1 "><input class="iptxt_1 ippwd_1" type="password" name="confirmpwd" /></div>
                        <div class="div_input_1 "><label class="float_f">Avatar</label><label class="file float_r"  for="imgUser">choisir un fichier<input class="fileBtn_1 float_r" type="file" onchange="prevUpload()" name="imgUser" id="imgUser"/></label></div>
                        <div class="div_input_1"><input class="ipbtn_1" type="submit" name="inscription" value="Créer compte">&nbsp;&nbsp;&nbsp;<a href="index.php"><small>Se connecter</small></a></div>
                    </form>
                </div>
            </div>
            <div class="box_right_1">
                <img class="imgProfil_1" alt='logo' id="avatar" src="public/icones/img5.jpg">
                <p class="center">Avatar <?=$msg_avt?> </p>
            </div>
            </div>
            </div>

            <script>
                function prevUpload()
                {
                    var file = document.getElementById("imgUser").files[0];
                    var reader = new FileReader();
                    if (file) {
                        reader.readAsDataURL(file);
                        reader.onloadend = function () {
                        document.getElementById("avatar").src = reader.result;
                        }
                    }
                    }
            </script>