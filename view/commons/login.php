<?php $title = 'Se connecter'; ?>

<?php ob_start(); ?>

            <p>
                <br><br>
            </p>
            <div class="box w50">
                <div class="head_box">
                   <span class="labhead">Login Form</span>
                </div>
                <div class="body_box">
                    <form action="index.php?origin=login" id="form_login" method="post">
                        <div class="div_input"><input class="iptxt iplogin" error="error-1" type="text" name="username" placeholder="Login"value="<?=$login ?>" ><div id="error-1" class="input_alert"></div> </div>
                        <div class="div_input "><input class="iptxt ippwd" error="error-2" type="password" name="password" placeholder="Password" ><div id="error-2" class="input_alert"></div> </div>
                        <div class="div_input"><Button class="ipbtn" type="submit" name="connexion" >Connexion</button>&nbsp;&nbsp;&nbsp;<a href="index.php?origin=inscription"><small>s'inscrire pour jouer</small></a></div>
                    </form>
                </div>
            </div>
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

                document.getElementById("form_login").addEventListener("submit",function(e)
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
                    if(error)
                    {
                        e.preventDefault();
                        return false;
                    }
                })
            </script>
<?php $content = ob_get_clean(); ?>

<?php require_once('template.php'); ?>