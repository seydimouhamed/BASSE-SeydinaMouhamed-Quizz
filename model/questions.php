<?php
	    function getDataQuestion()
	    {
	    	 $q = file_get_contents("db/questions.json");
	    	return json_decode($q,true);
		}
		
		function saveNbrQPJ($nbr)
		{
			$jsonData=json_encode($nbr);
			var_dump($jsonData);
			return file_put_contents("./db/nbrQPJ.json",$jsonData);
		}
		
		function getNbrQPJ()
		{
			$n = file_get_contents("db/nbrQPJ.json");
	    	return json_decode($n,true);
		}

		function saveQuestion($qts)
		{
			$db="db/questions.json";
			$q_json = file_get_contents($db);
			$data=json_decode($q_json,true);
			//mettre un id a la question
			$qts['id']=count($data)+1;
			//ajouter la nouvelle question
			$data[]=$qts;
			$jsonData=json_encode($data);

			return file_put_contents($db,$jsonData);
			

		}

		function updateQ($qts)
		{
			$db="db/questions.json";
			$q_json = file_get_contents($db);
			$data=json_decode($q_json,true);

			//récupération du id
			 $id=$qts['id'];
			//modification de la quesion
			$data[$id]=$qts;
			$jsonData=json_encode($data);

			if(file_put_contents($db,$jsonData))
			{
				$qts['register']=true;

				echo json_encode($qts);
			}else
			{
				$qts['register']=false;
				$dataJson=json_encode($qts);
				echo $dataJson;	
			}
			

		}
	    function newGame()
	    {
			$dq=getDataQuestion();
			$dj=array();
			foreach($dq as $q => $v)
			{
				if(!in_array($v['id'],$_SESSION['userInfo']['question_repondu']))
				{
					$dj[]=$v;
				}
			}
			shuffle($dj);
			$nbr=getNbrQPJ();
	    	$dj=array_slice($dj,0,$nbr);
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

		function percentTypeQuestion()
		{
			$lab="label";
			$dataPoints = array( 
				array($lab=>"choix text", "y"=>0),
				array($lab=>"choix Multi", "y"=>0),
				array($lab=>"choix Simple", "y"=>0)
			);

			$q=getDataQuestion();
			$nbrCT=0;
			$nbrCM=0;
			$nbrCS=0;
			$nbrT=0;
			foreach ($q as  $val) 
			{
				if($val["type"]==="ct")
				{
					$nbrCT++;
				}
				elseif($val["type"]==="cm")
				{
					$nbrCM++;
				}
				elseif($val["type"]==="cs")
				{
					$nbrCS++;
				}
				$nbrT++;

			}
			$dataPoints[0]['y']=($nbrCT/$nbrT)*100;
			$dataPoints[1]['y']=($nbrCM/$nbrT)*100;
			$dataPoints[2]['y']=($nbrCS/$nbrT)*100;

			return $dataPoints;
		}