<?php
 require('model/questions.php');
 $topScore=getUsersScore();
 $topScore=array_slice($topScore, 0,5);


 $subtitle="Bienvenue sur la plateforme de jeu de quizz<br/>
 Jouer et tester votre niveau de culture général";

 	function play($d=array())
 	{
		$cp=1;
		if(!empty($d))
		{
		    if(isset($d['prec']) || isset($d['suiv']) || isset($d['term']))
		    {
		        $p=$d['cp'];
		        $ind=$d['cp']-1;
		        @saveUserResponse($ind,$d['rep_user']);
		            if(isset($d['prec']))
		            {
		                $cp=($p-1);
		            }
		            elseif(isset($d['suiv']))
		            {
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
		$np=getNumberQtns();
		$ind=$cp-1;
		$tabuq=getQtn($ind);	
		

		$subtitle=$GLOBALS['subtitle'];	
		require('view/player/play.php');
 	}

 	function finjeu()
 	{
		$userInfo=$_SESSION['userInfo'];
		$tabT=$_SESSION['jeu'];
		$topScore=$GLOBALS['topScore'];
		$newScore=0;
		$question_trouve=array();
		$subtitle=$GLOBALS['subtitle'];	
		require('view/player/finjeu.php');
			if($newScore > $userInfo['score'])
			{
				$id=$userInfo['id'];
				setNewScore($id,$newScore);
				
			}
			if(!empty($question_trouve))
			{
				var_dump($question_trouve);
				$id=$userInfo['id'];
				registerQuestionRepondu($id,$question_trouve);	
			}
			
 	}