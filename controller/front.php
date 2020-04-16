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
				$userInfo = getUserByUserName($login);
				$_SESSION['userInfo']=$userInfo;
				$_SESSION['auth']=true;
				$_SESSION['auth_type'] = $userInfo['type'];
				if($userInfo['type']=='admin')
				{
					header("Location:index.php?origin=admin");
				}
				else
				{
					$subtitle="Bienvenue sur la plateforme de jeu de quizz<br/>
					Jouer et tester votre niveau de culture général";
					require("view/player/play.php");
				}
			}
		}
	}


	function register($ar=array())
	{
		if(empty($ar))
		{
			require("view/player/inscriptionPlayer.php");
		}
		else
		{
			//incription treatment!
		}
	}
