<?php
require('controller/front.php');

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
    elseif($o=='deconnexion')
    {
        $_SESSION=array();
        header('Location:index.php');
    }
    else
    {
        if(empty($_SESSION))
        {
            header('Location:index.php');
        }
        else
        {
            echo " redirecte page";
        }
    }

}
else 
{
    login();
}