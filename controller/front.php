<?php session_start();
 require('model/acompte.php');
	function login($form=array())
	{
		if(empty($form))
		{
			require("view/commons/login.php");
		}
		else
		{
			echo " venant du formulaire ";
			var_dump($form);
		}
	}

