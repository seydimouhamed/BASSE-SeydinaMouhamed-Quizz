<?php
require_once('controller/front.php');


$ac="action";



if ( isset($_GET['origin'])) 
{
    $o=$_GET['origin'];
    if($o=='login')
    {
        if(isset($_POST))
        {
            login($_POST);
        }
        else 
        {
            login();
        }
    }
    elseif($o=="inscription")
    {
        if(!empty($_POST))
        {
            register($_POST,$_FILES);
        }
        else 
        {
            register();
        }
    }
    elseif($o=='deconnexion')
    {
        $_SESSION=array();
        header('Location:index.php',true,303);
    }
    else
    {
        if(empty($_SESSION))
        {
            header('Location:index.php');
        }
        else
        {
            $type=$_SESSION['userInfo']['type'];
            if($o=='admin')
            { 
                if($type=="admin")
                {
                    require_once('controller/admin.php');
                    if(isset($_GET[$ac]))
                    {
                        $a=$_GET[$ac];
                        adminPage($a);
                    }
                    elseif(isset($_GET["updateQuestion"]))
                    {

                        updateQuestion($_POST);
                        

                    }
                    elseif(isset($_GET["changeStatut"]))
                    {
                            $id=$_GET["changeStatut"];
                            acDesPlayer($id);
                    }
                    elseif(isset($_GET["removePlayer"]))
                    {
                            $id=$_GET["removePlayer"];
                            removePlayer($id);
                    }
                    elseif(isset($_POST['register_question']))
                    {
                       registerQuestion($_POST);
                    }
                    elseif(isset($_POST['rnbrQuestion']))
                    {
                         updateNbrQPJ($_POST);
                    }
                    else
                    {
                        adminPage();
                    }
                }
                else
                {
                    header("location:index.php?origin=player");
                }
            }
            if($o=="player")
            {
                if($type=="user")
                {
                    require_once('controller/player.php');
                    $a=isset($_GET[$ac])?$_GET[$ac]:"pl";
                    if($a=="finjeu")
                    {
                        finjeu();
                    }
                    elseif($a=="profil")
                    {
                        profil();
                    }
                    else
                    {
                        $data =array();
                        if(!empty($_POST))
                        {
                            $data=$_POST;
                        }
                        play($data);
                    }
                }
                else
                {
                 
                    header("location:index.php?origin=admin");   
                }
                
            }
            elseif($o=="changeProfil")
            {
                changeProfil($_POST);
            }
        }
    }

}
else 
{
    login();
}