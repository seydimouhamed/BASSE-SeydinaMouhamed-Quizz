
	<div class="contain_pl">
	    <h2 class="h2">Listes des joueurs par score</h2>
	    <div class="contain_sub">

			<?php
			
	            if(empty($tabplayers))
	            {
	                echo "<h4>Rien à afficher</h4>";
	            }
	            else
	            {
	                echo "<table style='width:96%;margin-left:2%;'>";
	                echo"<tr><th>Nom</th><th>Prénom</th><th>Score</th></th>";
	                foreach($tabplayers as $u)
	                {
	                    echo "<tr><td style=' text-transform: uppercase;'>".$u['lastname']."</td><td style=' text-transform: capitalize;'>".$u['firstname']."</td><td>".$u['score']."pts</td></tr>";
	                }
	                echo "</table>";
	            }
	        ?>
	        
	    </div>

        <div class="div_nav">
            <a href='index.php?origin=admin&action=lq&p=$ps' class='ipbtn float_r'>Suivant</a>           
        </div>
	</div>