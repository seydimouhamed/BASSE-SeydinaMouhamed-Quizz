<?php
require_once('controller/front.php');


$ac="action";

// if(isset($_POST['updateUser']))
// {
// }

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
            if($o=='admin')
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
            if($o=="player")
            {
                require_once('controller/player.php');
                $a=isset($_GET[$ac])?$_GET[$ac]:"pl";
                if($a=="finjeu")
                {
                    finjeu();
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
        }
    }

}
else 
{
    login();
}