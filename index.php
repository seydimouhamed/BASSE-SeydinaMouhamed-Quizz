<?php
require_once('controller/front.php');

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
                    if(isset($_GET['action']))
                    {
                        $a=$_GET['action'];
                        adminPage($a);
                    }
                    elseif(isset($_POST['register_question']))
                    {
                        registerQuestion($_POST);
                    }
                    else
                    {
                        adminPage();
                    }
            }
            if($o=="player")
            {
                require_once('controller/player.php');
                 play();

            }
        }
    }

}
else 
{
    login();
}