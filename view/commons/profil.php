
<?php 
$fn=$ln=$login="";
$avatar="default.jpg";
$profil="";

if(isset($userInfo) )
{
    $fn=$userInfo['firstname'];
    $ln=$userInfo['lastname'];
    $login=$userInfo['login'];
    $profil=$userInfo['type'];
    if(isset($userInfo['avatar']))
    {
        $avatar=$userInfo['avatar'];
    }
}
?>
<link rel="stylesheet" type="text/css" href="public/css/styleInscription.css">      
<div class="div1_1">
                <div class="div2_1">
            <div class="box_left_1">
                <div class="width_90_1">
                    <span class="h2">Profil</span><br>
                    <small><?=@$msg_txt ?> </small>
                    <hr/>
                    <form action="index.php?origin=changeProfil" onsubmit="return validateChange()" method="post" id="form_register" enctype="multipart/form-data">
                        <input type="hidden" name="profil" value="<?=@$profil ?>"/>
                        <small for="fisrtname">Prénom</small><small id="error_1" class="input_alert float_r"></small>
                        <div class="div_input_1"><input class="iptxt_1 iplogin_1"  error="error_1" type="text" name="firstname" id="firstname" value="<?=$fn ?>"/></div>
                        <small for="lastname">Nom</small><small id="error_2" class="input_alert float_r"> </small>
                         <div class="div_input_1 "><input class="iptxt_1 ippwd_1" error="error_2"  type="text" name="lastname" id="lastname" value="<?=$ln ?>" /></div>
                        <small for="lastname">Login</small><small id="error_3" class="input_alert float_r"> </small>
                        <div class="div_input_1 "><input class="iptxt_1 ippwd_1" error="error_3"  type="text" id='login' name="login" value="<?=$login ?>" /></div>
                        <!-- <small for="lastname">Password</small><small id="error_4" class="input_alert float_r"> </small>
                        <div class="div_input_1 "><input class="iptxt_1 ippwd_1"  error="error_4" id="pwd"  type="password" name="pwd" /></div>
                        <small for="lastname">Confirm password</small><small id="pwd_ctxt" class="input_alert float_r"></small>
                        <div class="div_input_1 "><input class="iptxt_1 ippwd_1" type="password" id="pwd_c" name="confirmpwd" /></div> -->
                        <div class="div_input_1 "><label class="float_f">Avatar</label><label class="file float_r"  for="imgUser">changer d'image<input class="fileBtn_1 float_r" error="error_f" type="file" onchange="prevUpload()" name="imgUser" id="imgUser" accept="image/png, image/jpeg"/></label></div> 
                        <div class="div_input_1"><button class="ipbtn_1" type="submit" name="changeProfil" >Actualiser</button>&nbsp;&nbsp;&nbsp;
                    
                        </div>
                    </form>
                </div>
            </div>
            <div class="box_right_1">
                <img class="imgProfil_1" alt='logo' id="avatar" src="public/imageUsers/<?=$avatar ?>">
                
                <p class="center">Avatar <?=@$msg_avt?> <br><small id="error_f" class="input_alert float_r"> </small></p>
            </div>
            </div>
            </div>
<script>
function validateChange()
{
var fn=document.getElementById('firstname').value.trim();
var ln=document.getElementById('lastname').value.trim();
var lg=document.getElementById('login').value.trim();
//alert(" "+fn+" "+ln+" "+lg)
    if(!fn || !ln || !lg )
    {
        document.getElementById('error_1').innerText="Veuillez remplir tous les champs!";
        return false;
    }
    else
    {
        return true;
    }
}

function prevUpload()
{

    document.getElementById('error_f').innerText="";
    var file = document.getElementById("imgUser").files[0];
    var reader = new FileReader();
    if (file) 
    {
        reader.readAsDataURL(file);
        reader.onloadend = function () 
        {
        document.getElementById("avatar").src = reader.result;
        }
    }
}
</script>