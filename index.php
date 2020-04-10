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
}
else 
{
    login();
}