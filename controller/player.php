<?php
 require('model/questions.php');
 $topScore=getUsersScore();
 $topScore=array_slice($topScore, 0,5);

 	function play($d=array())
 	{
		$cp=1;
		if(!empty($d))
		{
		    if(isset($d['prec']) || isset($d['suiv']) || isset($d['term']))
		    {
		        $p=$d['cp'];
		        $ind=$d['cp']-1;
		        //$_SESSION['jeu'][$ind]['currep']=$d['rep_user'];
		        saveUserResponse($ind,$d['rep_user']);
		            if(isset($d['prec']))
		            {echo"on est la";
		                $cp=($p-1);
		            }
		            elseif(isset($d['suiv']))
		            {echo"on est la suiv";
		                $cp=($p+1);
		            }
		            elseif(isset($d['term']))
		            {
		                header('Location:index.php?origin=player&action=finjeu');   
		            }
		    }
		}
		else
		{
			newgame();
		}


		$userInfo=$_SESSION['userInfo'];
		$topScore=$GLOBALS['topScore'];
		var_dump($topScore);
		//$tabT=$_SESSION['jeu'];
		$np=getNumberQtns();
		$ind=$cp-1;
		$tabuq=getQtn($ind);

		require('view/player/play.php');
 	}

 	function finjeu()
 	{
		$userInfo=$_SESSION['userInfo'];
		$tabT=$_SESSION['jeu'];
		$topScore=$GLOBALS['topScore'];
		$newScore=3;

		require('view/player/finjeu.php');

		if($newScore>$userInfo['score'])
		{
			setNewScore($newScore);
		}
		else
		{
			setNewScore($newScore);
			echo "<br>score inferieur $newScore";
		}
 	}