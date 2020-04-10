<?php
 require('model/questions.php');
  // require('model/acompte.php');
		function listquestion()
		{
			$userInfo=$_SESSION['userInfo'];
			$tabQuestion=getDataQuestion();
			$nbP=ceil(count($tabQuestion)/5);
			
			$pa=1;
			    if(isset($_GET['p']))
			    {
			        $pa=$_GET['p'];
			    }
			$pp=$pa-1;
			$ps=$pa+1;
			$cp="lq";
			require("view/admin/listQuestions.php");
		}


		function listPlayer()
		{
			$userInfo=$_SESSION['userInfo'];
			$tabplayers=getUsersScore();
			$nbP=ceil(count($tabplayers)/5);
			$cp="lp";

			require("view/admin/playerList.php");

		}

		function createAdmin()
		{
			$userInfo=$_SESSION['userInfo'];
			$cp="ca";
			require("view/admin/createAdmin.php");

		}

		function createQuestion()
		{
			$userInfo=$_SESSION['userInfo'];
			$cp="cq";
			require("view/admin/createQuestions.php");

		}


		 // function trie($a, $b) 
		 // {
		 //    if ($a['score'] == $b['score']) return 0;
		 //    return ($a['score'] < $b['score']) ? 1 : -1;
			
		 // }



		// function paginateQuestion($tab,$page=1)
		// {
		//     $nbPage=ceil(count($tab)/5);
		//     $indDep=($page-1)*5;
		//     $indDar=$indDep+5;
		//     echo "<ol>";
		//     for($i=$indDep;$i<$indDar;$i++)
		//     {
		//         if(array_key_exists($i,$tab))
		//         {
		//             echo "$i <br>";
		//         }
		//         else
		//         {
		//         break;
		//         }
		//     }
		//     echo"</ol>";
		// }
		 

		 function paginateQuestion($tab,$page=1)
			{
			    $nbPage=ceil(count($tab)/5);
			    $indDep=($page-1)*5;
			    $indDar=$indDep+5;
			    echo "<ol class='ol'>";
			    for($i=$indDep;$i<$indDar;$i++)
			    {
			        if(array_key_exists($i,$tab))
			        {
			            $q=$tab[$i];
			            echo "<li> <b> ".($i+1).". ".$q['question']." </b></li>";
			            if($q['type']=="cm")
			            {
			                echo"<ul>";
			                foreach($q['reponses'] as $u)
			                {
			                    echo "<li style='list-style-type:square'><xmp> $u </xmp></li>";
			                }
			                echo "</ul>";
			            }
			            elseif($q['type']=="cs")
			            {

			                echo"<ul>";
			                foreach($q['reponses'] as $u)
			                {
			                    echo "<li style='list-style-type:circle'><xmp> $u </xmp></li>";
			                }
			                echo "</ul>";
			            }
			            else
			            {
			                echo"<input type='text' >";
			            }
			        }
			        else
			        {
			        break;
			        }
			    }
			    echo"</ol>";
			}