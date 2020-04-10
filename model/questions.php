<?php
	    function getDataQuestion()
	    {
	    	 $q = file_get_contents("db/questions.json");
	    	return json_decode($q,true);
	    }

	    function newGame()
	    {
	    	$dq=getDataQuestion();
	    	shuffle($dq);
	    	$dj=array_slice($dq,0,10);
	    	$_SESSION['jeu']=$dj;
	    }

		function getAllQtns()
		{
			return $_SESSION['jeu'];
		}


		function getQtn($id)
		{
			return $_SESSION['jeu'][$id];
		}

		function getNumberQtns()
		{
			return count($_SESSION['jeu']);
		}

		function saveUserResponse($id,$resp)
		{
			$_SESSION['jeu'][$id]['currep']=$resp;
		}