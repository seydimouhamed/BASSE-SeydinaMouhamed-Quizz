
<?php 
$fn=$ln="";
if(isset($_SESSION["form"]) && !empty($_SESSION["form"]) )
{
    $fn=$_SESSION["form"]["firstname"];
    $ln=$_SESSION["form"]["lastname"];
}
?>
<link rel="stylesheet" type="text/css" href="public/css/styleInscription.css">      
<div class="div1_1">
                <div class="div2_1">
            <div class="box_left_1">
                <div class="width_90_1">
                    <span class="h2">s'inscrire</span><br>
                    <small><?=$msg_txt ?> </small>
                    <hr/>
                    <form action="index.php?origin=inscription" method="post" id="form_register" enctype="multipart/form-data">
                        <input type="hidden" name="profil" value="<?=$profil ?>"/>
                        <small for="fisrtname">Prénom</small><small id="error_1" class="input_alert float_r"></small>
                        <div class="div_input_1"><input class="iptxt_1 iplogin_1" id="er" error="error_1" type="text" name="firstname" value="<?=$fn ?>"/></div>
                        <small for="lastname">Nom</small><small id="error_2" class="input_alert float_r"> </small>
                        <div class="div_input_1 "><input class="iptxt_1 ippwd_1" error="error_2"  type="text" name="lastname" value="<?=$ln ?>" /></div>
                        <small for="lastname">Login</small><small id="error_3" class="input_alert float_r"> </small>
                        <div class="div_input_1 "><input class="iptxt_1 ippwd_1" error="error_3"  type="text" name="login" /></div>
                        <small for="lastname">Password</small><small id="error_4" class="input_alert float_r"> </small>
                        <div class="div_input_1 "><input class="iptxt_1 ippwd_1"  error="error_4" id="pwd"  type="password" name="pwd" /></div>
                        <small for="lastname">Confirm password</small><small id="pwd_ctxt" class="input_alert float_r"></small>
                        <div class="div_input_1 "><input class="iptxt_1 ippwd_1" type="password" id="pwd_c" name="confirmpwd" /></div>
                        <div class="div_input_1 "><label class="float_f">Avatar</label><label class="file float_r"  for="imgUser">choisir un fichier<input class="fileBtn_1 float_r" error="error_f" type="file" onchange="prevUpload()" name="imgUser" id="imgUser" accept="image/png, image/jpeg"/></label></div>
                        <div class="div_input_1"><button class="ipbtn_1" type="submit" name="inscription" >Créer compte</button>&nbsp;&nbsp;&nbsp;<a href="index.php" class="a"><small>Se connecter</small></a></div>
                    </form>

            <script>

                const inputs = document.getElementsByTagName("input");
                for(input of inputs)
                {
                    input.addEventListener("keyup",function(e)
                    {
                        if(e.target.hasAttribute("error"))
                        {
                            var idDivError=e.target.getAttribute("error");
                            document.getElementById(idDivError).innerText="";
                        }
                    })
                }

            document.getElementById("pwd_c").addEventListener("keyup",function()
            {
                var pwd=document.getElementById("pwd").value;
                var pwd_c=document.getElementById("pwd_c").value;
                if(pwd_c===pwd)
                {
                    document.getElementById('pwd_ctxt').innerText="";

                }
                else
                {
                    document.getElementById('pwd_ctxt').innerText="les mots de passes ne sont pas identiques";

                }
            });

                document.getElementById("form_register").addEventListener("submit",function(e)
                {   
                    const inputs=document.getElementsByTagName("input");
                    var error=false;
                    for(input of inputs)
                    {
                        if(input.hasAttribute("error"))
                        {
                            var idDivError = input.getAttribute("error");
                            if(!input.value)
                            {
                                document.getElementById(idDivError).innerText='ce champ est obligatoitre';
                                error=true;
                            }
                        }

                    }

                    
                    var pwd=document.getElementById("pwd").value;
                    var pwd_c=document.getElementById("pwd_c").value;
                    errorpwd=false;
                    if(pwd!==pwd_c || pwd.length<5)
                    {
                        errorpwd=true;
                    }
                    
                    if(error || errorpwd)
                    {
                        e.preventDefault();
                        return false;
                    }
                })

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
                </div>
            </div>
            <div class="box_right_1">
                <img class="imgProfil_1" alt='logo' id="avatar" src="public/icones/img5.jpg">
                
                <p class="center">Avatar <?=$msg_avt?> <br><small id="error_f" class="input_alert float_r"> </small></p>
            </div>
            </div>
            </div>
