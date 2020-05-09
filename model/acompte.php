<?php
	

    function getData()
    {
    	 $user_data = file_get_contents("db/connexion.json");
    	return json_decode($user_data,true);
    }

    function setData($d)
    {
        $jsonData=json_encode($d);

         return file_put_contents('db/connexion.json',$jsonData);
         
    }

     function getPlayers()
     {
        $tab=getData();
         $tabplayers=array();
        foreach($tab as $u)
        {
            if($u['type']=="user")
            {
                $tabplayers[]=$u;
            }
        }
        return $tabplayers;
     }
    
	function checkUserLog($log,$pwd)
	{
		$c=getData();
        foreach($c as $val)
        {
            if($val['login']==$log && $val['pwd']==$pwd)
            {
                return true;
            }
            
        }
        return false;

	}	


	function checkUserNameExist($un)
	{
		$c=getData();
		return array_search($un,array_column($c,"login"));
	}


//----------------------------------------------------------------------------------------------------------------


	function getUsersScore()
	{
		$c=getData();
		$allUsersScore=array();
		foreach ($c as $i => $val) 
		{
            if($val['type']=='user')
            {
			     $allUsersScore[]=array("firstname"=>$val['firstname'],"lastname"=>$val['lastname'],"score"=>$val["score"],"statut"=>$val["statut"], "id" =>$i);
            }
		}

        usort($allUsersScore, 'trie');
		return $allUsersScore;
    }




    function acDesPlayer($i)
    {
        $c=getData();
        if(array_key_exists($i,$c))
        {
            if($c[$i]['statut']=="on")
            {
                $c[$i]['statut']="off";
            }
            else
            {
                $c[$i]['statut']="on";
            }
        }
        $msg=array();
        if(setData($c))
        {
				$msg=array('type'=>'succes','text'=>'Le statut a été actualisé avec succes!');
				
        }	
        else
        {
				$msg=array('type'=>'alert','text'=>'Le statut n\'a été pas actualisé!');
				
        }

        $_SESSION['msg']=$msg;
		header('Location:index.php?origin=admin&action=joueurs');
    }

    function removePlayer($i)
    {
        $c=getData();
        if(array_key_exists($i,$c))
        {
            unset($c[$i]);
        }

        $msg=array();

        if(setData($c))
        {
				$msg=array('type'=>'succes','text'=>'Le compte a été supprimé!');
				
        }	
        else
        {
				$msg=array('type'=>'alert','text'=>'Le compte n\'a été pas supprimé!');
				
        }

        $_SESSION['msg']=$msg;
		header('Location:index.php?origin=admin&action=joueurs');
    }

    
         function trie($a, $b) 
         {
            if ($a['score'] == $b['score']){ return 0;}
            return ($a['score'] < $b['score']) ? 1 : -1;
            
         }


         function registerQuestionRepondu($i,$qr)
         {
            $c=getData();
            if(array_key_exists($i,$c))
            {
                foreach($qr as $val)
                {
                    $c[$i]['question_repondu'][]=$val;
                }
            }
           return setData($c);

         }

            function setNewScore($i,$score)
            {
                $c=getData();
                if(array_key_exists($i,$c))
                {
                    $c[$i]['score']=""+$score;
                }
               return setData($c);
            }
//----------------------------------------------------------------------------------------------------------------

	function getUserByUserName($un)
	{
        $c=getData();
        $i=0;
		foreach ($c as $i => $val) 
		{
			if($val['login']==$un)
			{
                $val['id']=$i;
               return $val;
			}
			$i++;
		}

		return "";
    }



//----------------------------------------------------------------------------------------------------------------


    function registerUserAvatar($avatar)
    {
        $target_dir = "public/imageUsers/";
        //avoir le temps en millisecondes
        $mt = explode(" ",microtime());
        $currenttime = (((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000)));
        $newBasename=$currenttime.basename($avatar["name"]);
        $target_file = $target_dir .$newBasename;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"]))
        {
            $check = getimagesize($avatar["tmp_name"]);
            if($check !== false)
            {
                //dsklsfdkml
                $uploadOk = 1;
            } 
            else
            {
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) 
        {
            $uploadOk = 0;
        }
        // Check file size
        if ($avatar["size"] > 500000)
        {
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" )
        {
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) 
        {
            return "default.png";
        } 
        else 
        {
            if (move_uploaded_file($avatar["tmp_name"], $target_file))
            {
                return $newBasename;
                
            } else 
            {
                return "default.png";
            }
        }
    }

//----------------------------------------------------------------------------------------------------------------

function registeruser($log,$pwd,$fn,$ln,$pfl,$f_imguser)
{ 
			$c=getData();          
            $avatar=registerUserAvatar($f_imguser);

            $userDetInfo=array("login"=>$log,"pwd"=>$pwd,"firstname"=>$fn,"lastname"=>$ln,"avatar"=>$avatar,"score"=>0,"type"=>$pfl,"statut"=>"on");
            $c[]=$userDetInfo;
            $jsonData=json_encode($c);

             if(file_put_contents('db/connexion.json',$jsonData))
             {
             	return true;
             }

      return false;       
             
}