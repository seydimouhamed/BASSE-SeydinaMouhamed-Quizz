<?php
 require('model/questions.php');
		function adminPage($page="joueurs")
		{
			$userInfo=$_SESSION['userInfo'];
			$subtitle="<br>Créer et paramétrer vos quizz";
			$p=$page;
			
			$t=getDataQuestion();
			$tabQuestion=array_reverse($t);
			$nbP=ceil(count($tabQuestion)/5);
			
			require("view/admin/home.php");
		}

		function registerQuestion($post)
		{
			$reponses=array();
			$breponses=array();
			unset($post["register_question"]);
			
			if($post["type"]!=="ct")
			{
				$index=1;
				foreach ($post as $key => $p) 
				{
					if(strpos($key, "reponse")!== FALSE)
					{
						$reponses[]=$p;
						// l'enleve le bouton submit il ne me restera que les données
						unset($post[$key]);
						if(in_array(substr($key, 8), $_POST['check']))
						{
							$breponses[]="$index";
						}
						$index++;
					}
				}
				// l'enleve larray check contenant les numéros désordonnées!
				unset($post["check"]);

				$post+= ["reponses" => $reponses];
				$post["breponses"]=$breponses;
				 
			}
			 
			$post+=["currep"=>array()];	
			if(saveQuestion($post))
			{
				header('Location:index.php?origin=admin&action=listQuestion');
			}
			else
			{
				header('Location:index.php?origin=admin&action=createAdmin');
			}
			

		}







		function paginateJoueurs($tab,$page=1)
		{

			$nbPage=ceil(count($tab)/2);
			$indDep=($page-1)*$nbPage;
			$indDar=$indDep+2;
			if(empty($tab))
			{
				echo "<h4>Rien à afficher</h4>";
			}
			else
			{
				echo "<table style='width:96%;margin-left:2%;'>";
				echo"<tr><th>Nom</th><th>Prénom</th><th>Score</th></th>";
				for($i=$indDep;$i<$indDar;$i++)
				{
			        if(array_key_exists( intval($i) ,$tab))
			        {
						echo "<tr><td style=' text-transform: uppercase;'>".$tab[$i]['lastname']."</td><td style=' text-transform: capitalize;'>".$tab[$i]['firstname']."</td><td>".$tab[$i]['score']."pts</td></tr>";
					}
				}
				echo "</table>";
			}
		}
		 

		 function paginateQuestion($tab,$page=1)
			{
			    $nbPage=ceil(count($tab)/5);
			    $indDep=($page-1)*5;
			    $indDar=$indDep+5;
			    echo "<div class='ol'>";
				$number=1;
			    for($i=$indDep;$i<$indDar;$i++)
			    {
			        if(array_key_exists($i,$tab))
			        {
						$q=$tab[$i];
						$urep=$q["breponses"];
			            echo "<b class='sm_font13 mg_2'> ".($i+1).". ".$q['question']." </b>";
			            if($q['type']=="cm")
			            {
			                echo"<ul class='ul admin'>";
							$num=1;
			                foreach($q['reponses'] as $u)
			                {
								echo '<label class="c_rep sm_font"><xmp>'.$u.'</xmp>
										<input type="checkbox" disabled  name="rep_user[]" value=""';
										if(!empty($urep))
										{ 
											if(in_array($num,$urep))
											{ 
												echo "checked";
											} 
										}
										echo '>
										<span class="check" ></span>
									</label>';

								$num++;
			                }
			                echo "</ul>";
			            }
			            elseif($q['type']=="cs")
			            {

			                echo"<ul>";
							$num=1;
			                foreach($q['reponses'] as $u)
			                {
								echo '<label class="c_rep sm_font"><xmp>'.$u.'</xmp>
                                            <input type="radio" disabled name="rep_user'.$number.'[]" ';
                                            if(!empty($urep))
                                            { 
                                                if(in_array($num,$urep))
                                                { echo "checked";} 
                                            }
                                            echo '  >
                                            <span class="checkmark"></span>
										</label>';	
								
								$num++;
							}
			                echo "</ul>";
			            }
			            else
			            {
			                echo '<input class="iptxt w80" disabled  type="text" name="rep_user[]" value="';
                                if(!empty($urep))
                                { 
                                    echo $urep[0];
                                }
                                echo '" required> <hr>';
						}
                        $number++;
			        }
			        else
			        {
			        break;
			        }
			    }
			    echo"</div>";
			}