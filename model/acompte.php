<?php
	

    function getData()
    {
    	 $user_data = file_get_contents("db/connexion.json");
    	return json_decode($user_data,true);
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
		foreach ($c as $val) 
		{
            if($val['type']=='user')
            {
			     $allUsersScore[]=array("firstname"=>$val['firstname'],"lastname"=>$val['lastname'],"score"=>$val["score"]);
            }
		}

        usort($allUsersScore, 'trie');
		return $allUsersScore;
    }





         function trie($a, $b) 
         {
            if ($a['score'] == $b['score']) return 0;
            return ($a['score'] < $b['score']) ? 1 : -1;
            
         }




            function setNewScore($score)
            {
                $un=$_SESSION['userInfo']['login'];
                $n=getUserByUserName($un);
                print_r($_SESSION['userInfo']);

            }
//----------------------------------------------------------------------------------------------------------------

	function getUserByUserName($un)
	{
		$c=getData();
		foreach ($c as $val) 
		{
			if($val['login']==$un)
			{
               return $val;
			}
			
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
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } 
            else
            {
                //echo "File is not an image.";
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

function registeruser($log,$pwd,$fn,$ln,$f_imguser)
{ 
			$c=getData();          
            $avatar=registerUserAvatar($f_imguser);

            $userDetInfo=array("login"=>$log,"pwd"=>$pwd,"firstname"=>$fn,"lastname"=>$ln,"avatar"=>$avatar,"score"=>0);
            $c[]=$userDetInfo;
            $jsonData=json_encode($c);

             if(file_put_contents('db/connexion.json',$jsonData))
             {
             	return true;
             }

      return false;       
             
}