<?php
 require('model/questions.php');
		function adminPage($page="joueurs")
		{
			$userInfo=$_SESSION['userInfo'];
			$subtitle="<br>Créer et paramétrer vos quizz";
			$p=$page;
			
			$t=getDataQuestion();
			$nbrQJ=getNbrQPJ();
			$tabQuestion=$t;
			$nbP=ceil(count($tabQuestion)/5);
			
			require("view/admin/home.php");
		}

		function updateQuestion($post)
		{
			$reponses=array();
			$breponses=array();
			unset($post["updateQuestion"]);
			$rep="reponses";
			if($post["type"]!=="ct")
			{
				$index=1;
				foreach ($post as $key => $p) 
				{
					if(strpos($key, "reponse")!== FALSE && $p!="")
					{
						$reponses[]=$p;
						// l'enleve le bouton submit il ne me restera que les données
						unset($post[$key]);
						if(in_array(substr($key, 8), $post['check']))
						{
							$breponses[]="$index";
						}
						$index++;
					}
				}
				// l'enleve larray check contenant les numéros désordonnées!
				unset($post["check"]);

				$post+= [$rep => $reponses];
				$post["breponses"]=$breponses;

			}

			$post+=["currep"=>array()];	
			updateQ($post);

		}

		function registerQuestion($post)
		{
			$reponses=array();
			$breponses=array();
			unset($post["register_question"]);
			$rep="reponses";
			if($post["type"]!=="ct")
			{
				$index=1;
				foreach ($post as $key => $p) 
				{
					if(strpos($key, "reponse")!== FALSE)
					{
						if($p!="")
						{
							$reponses[]=$p;
							// l'enleve le bouton submit il ne me restera que les données
							unset($post[$key]);
							if(in_array(substr($key, 8), $_POST['check']))
							{
								$breponses[]="$index";
							}
						}
						else
						{
							unset($post[$key]);
						}
						$index++;
					}
				}
				// l'enleve larray check contenant les numéros désordonnées!
				unset($post["check"]);

				$post+= [$rep => $reponses];
				$post["breponses"]=$breponses;
				 
			}
			 
			$post+=["currep"=>array()];	
			if(saveQuestion($post))
			{
				header('Location:index.php?origin=admin&action=listQuestion');
			}
			else
			{
				header('Location:index.php?origin=admin&action=createQuestion1');
			}
			

		}



		function updateNbrQPJ($p)
		{
			$nbr=$p['nbrQJ'];
			$msg="";
			if(!saveNbrQPJ($nbr))
			{
				$msg=array('type'=>'alert','text'=>'Le nombre de question par jeu n\'a pas été actualisé');
			}	
			else
			{
				$msg=array('type'=>'succes','text'=>'Le nombre de question par jeu a été actualisé avec succès');
			}
				$_SESSION['msg']=$msg;
			
			header('Location:index.php?origin=admin&action=listQuestion');
			
		}



		function paginateJoueurs($tab,$page=1)
		{

			$indDep=($page-1)*2;
			$indDar=$indDep+2;
			if(empty($tab))
			{
			?>
				<h4>Rien à afficher</h4>
			<?php
			}
			else
			{
			?>
				<table class="table">
					<caption> </caption>
				<tr><th scope="col">Nom</th><th scope="col">Prénom</th><th scope="col">Score</th></th>
			<?php
				for($i=$indDep;$i<$indDar;$i++)
				{
			        if(array_key_exists( intval($i) ,$tab))
			        {
				?>
							<tr><td style=' text-transform: uppercase;'><?=$tab[$i]['lastname']?></td><td style=' text-transform: capitalize;'><?=$tab[$i]['firstname']?></td><td><?=$tab[$i]['score']?>pts</td><td> <span onclick="removeUser(<?=$tab[$i]['id']?>)">&#x274C;</span> &nbsp;&nbsp;&nbsp;
						<?php
						if($tab[$i]['statut']=="on"){echo "<span onclick='changeStatut(".$tab[$i]['id'].");'>&#128272;</span>";}else{ echo "<span onclick='changeStatut(".$tab[$i]['id'].");'>&#128275;</span>";}
						?>
							</td></tr>
						<?php
					}
				}
				?>
					</table>
				<?php
			}
		}
		 

		 function paginateQuestion($tab,$page=1)
			{
			    $nbPage=ceil(count($tab)/5);
			    $indDep=($page-1)*5;
				$indDar=$indDep+5;
				?>
			   		<div class='ol'>
				<?php
				$number=1;
			    for($i=$indDep;$i<$indDar;$i++)
			    {
			        if(array_key_exists($i,$tab))
			        {
						$q=$tab[$i];
						$urep=$q["breponses"];
						?>
							<div><input type="checkbox" name="check" class="mod" id="q_check_<?=$i ?>" value="<?=$i ?>"></span>
							<?=($i+1)?>
							<div id="<?=$i ?>">&nbsp;&nbsp;<strong class='sm_font13 mg_2' id="qts_<?=$i ?>"><?= $q['question'] ?> </strong>
							<input type="hidden" id="data_<?=$i?>" typeChoix="<?=$q['type']?>" score="<?=$q['score']?>" nbrRep="<?php if(isset($q['reponses'])){echo count($q['reponses']);}else{echo "1";}?>"/>
			            	
					   <?php
						if($q['type']=="cm")
			            {
							displayCM($i,$q,$urep);
			            }
			            elseif($q['type']=="cs")
			            {
							displayCS($i,$q,$urep,$number)
							?>
								</ul>
						<?php
			            }
			            else
			            {
							displayCT($i,$q,$urep);
							?>
							
						<?php
						}
						$number++;?>
						
						</div>
						<?php
			        }
			        else
			        {
			        break;
			        }
				}
				?>
					</div>
				<?php
			}

			
			function displayCM($i,$q,$urep)
			{
				?>

				<ul class='ul admin'>
				<?php
				$num=1;
				foreach($q['reponses'] as $u)
				{
					?>
						<label class="c_rep sm_font" id="rep_<?php echo $i."_".$num;?>"><?=htmlentities($u) ?>
							<input type="checkbox" id="chk_<?php echo $i."_".$num;?>" disabled  name="rep_user[]" value=""
							<?php
							if(!empty($urep) && in_array($num,$urep))
							{ 
									echo "checked";
							}
							?>/>
							<span class="check" ></span>
						</label>
				<?php
					$num++;
				}
				?>
					</ul>
			<?php	
			}

			function displayCS($i,$q,$urep,$number)
			{
				?>
					<ul>
				<?php
				$num=1;
				foreach($q['reponses'] as $u)
				{
				?>
						<label class="c_rep sm_font" id="rep_<?php echo $i."_".$num;?>"><?=htmlentities($u)?>
								<input type="radio" disabled id="chk_<?php echo $i."_".$num;?>" name="rep_user<?=$number ?>[]" 
								<?php
								if(!empty($urep) && in_array($num,$urep))
								{ 
									 echo "checked";
								}
								?>
								/>
								<span class="checkmark"></span>
							</label>	
				<?php	
					$num++;
				}

			}

			function displayCT($i,$q,$urep)
			{
				?>
				<input class="iptxt w80" disabled id="rep_<?=$i?>"  type="text" name="rep_user[]" value="<?=@$urep[0]?>" required> <hr>
			<?php
			}