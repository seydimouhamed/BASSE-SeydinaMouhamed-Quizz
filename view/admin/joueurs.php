
	<div class="contain_pl">
	    <h2 class="h2">Listes des joueurs par score</h2>
	    <div class="contain_sub">

			<?php

			$tab=getUsersScore();
			$nbP=ceil(count($tab)/2);
			$pa=1;
			    if(isset($_GET['p']))
			    {
			        $pa=$_GET['p'];
			    }
			$pp=$pa-1;
			$ps=$pa+1;
			paginateJoueurs($tab,$pa)
	        ?>
	        
	    </div>

        <div class="div_nav">
			
		<?php if($pp>=1){?>
                <a href='index.php?origin=admin&action=joueurs&p=<?=$pp?>' class='ipbtn float_l'>Précédent</a>
            <?php
            }
            if($ps<$nbP){
            ?>
                <a href='index.php?origin=admin&action=joueurs&p=<?=$ps?>' class='ipbtn float_r'>Suivant</a>           
            <?php
            }
            ?>
         </div>
	</div>