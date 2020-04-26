<?php
	    function getDataQuestion()
	    {
	    	 $q = file_get_contents("db/questions.json");
	    	return json_decode($q,true);
	    }

		function saveQuestion($qts)
		{
			$db="db/questions.json";
			$q_json = file_get_contents($db);
			$data=json_decode($q_json,true);

			//ajouter la nouvelle question
			$data[]=$qts;
			$jsonData=json_encode($data);

			return file_put_contents($db,$jsonData);
			

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