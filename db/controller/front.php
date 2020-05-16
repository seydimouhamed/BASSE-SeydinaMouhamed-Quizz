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
				$msg[]=array('type'=>'alert','text'=>'Le nom utilisateur ou le mot de passe est incorrect');
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
					header("Location:index.php?origin=player");
				}
			}
		}
	}

	

	function register($d=array(),$f=array())
	{

		array_walk($d, 'trim_value');
		if(empty($d))
		{
			require("view/player/inscriptionPlayer.php");
		}
		else
		{
			if(isset($d['inscription']))
			{
				$msg=array();
	
				if( empty($d["login"]) || empty($d["firstname"]) || empty($d["pwd"]))
				{
					$msg[]=array('type'=>'alert','text'=>'veuillez remplir tous les champs');
					$_SESSION['msg']=$msg;
					header("Location:index.php?origin=inscription");
				}
				else
				{
					if(getUserByUserName($d["login"])!=="")
					{
						$msg[]=array('type'=>'alert','text'=>'Ce login est déjà utilisé!Veuillez choisir un autre login!');
						$_SESSION['msg']=$msg;
						$_SESSION['form']=$d;
						if($d["profil"]=="user")
						{
							header("Location:index.php?origin=inscription");
						}
						else
						{
							header("Location:index.php?origin=admin&action=createAdmin");
						}	
					}
					else
					{
						if(!registeruser($d["login"],$d["pwd"],$d["firstname"],$d["lastname"],$d["profil"],$f["imgUser"]))
						{
							echo " erreur lors de l'inscription";
							header("Location:index.php?action=register");
		
						}
						else
						{
							$msg[]=array('type'=>'succes','text'=>'Le compte a été créer avec succes!');
							$_SESSION['msg']=$msg;
							$_SESSION['form']=array();

							if($d["profil"]=="user")
							{
								$dl=array('username'=>$d['login'],'password'=>$d['pwd']);
								login($dl);
							}
							else
							{
								header("Location:index.php?origin=admin");
							}
						}
					}
				}
			}
		}
	}

	function routeInscription($d,$message,$tmsg)
	{
		$msg=array('type'=>$tmsg,'text'=>$message);
		$_SESSION['msg']=$msg;
		$_SESSION['form']=$d;
		if($d["profil"]=="user")
		{
			header("Location:index.php?origin=inscription");
		}
		else
		{
			header("Location:index.php?origin=admin&action=createAdmin");
		}

	}

	function changeProfil($p)
	{
		array_walk($p, 'trim_value');
		extract($p);
		$change=checkChangeNames($firstname,$lastname,$login);

		$msg=[];
		if(array_key_exists('login',$change['toChange']) && checkUserNameExist($login))
		{
			$msg[]=array('type'=>'alert','text'=>'Le nom d\'utilisateur existe déja!');
			
			unset($change['toChange']['login']);

		}
		if(empty($change['toChange']))
		{
			$msg[]=array('type'=>'info','text'=>'aucun changement n\'a été effectué!');
			
			$_SESSION['msg']=$msg;
			redirecte();
		}
		else
		{
			if(changeData($change['toChange']))
			{
				$userInfo = getUserByUserName($login);
				$_SESSION['userInfo']=$userInfo;
				redirecte();
			
			}
		}
	}

	function trim_value(&$value)
	{
		$value = trim($value);
	}

function redirecte()
{

	if($_SESSION['userInfo']['type']=="admin")
	{
		header('location:index.php?origin=admin&action=profilAdmin');
	}
	else
	{
		header('location:index.php?origin=player&action=profil');
	}
}