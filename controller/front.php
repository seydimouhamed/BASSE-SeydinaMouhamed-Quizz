<?php session_start();
 require('model/acompte.php');
	function login($form=array())
	{
		$login="";
		if(empty($form))
		{
			require("view/commons/login.php");
		}
		else
		{
			$login = $form['username'];
			$pwd = $form['password'];
			if(!checkUserLog($login,$pwd))
			{
				$msg=array('type'=>'alert','text'=>'Le nom utilisateur ou le mot de passe est incorrect');
				$_SESSION['msg']=$msg;
				require("view/commons/login.php");
			}
			else
			{
				$usrInfo = getUserByUserName($login);
				if($usrInfo['type']=='admin')
				{
					echo " un admin s'est connecté";
				}
				else
				{
					echo " un joueur s'est connecté ";
				}
			}
		}
	}

