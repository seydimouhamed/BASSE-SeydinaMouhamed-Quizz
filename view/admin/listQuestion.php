<div class="contain_pl">
        
        <div class="div_head">
            <span>
                <form action="" method="POST">
                    Nbr de question/jeu
                    <input type="number" name="nbrQJ" value="5"/>
                    <input type="submit" name="rnbrQuestion" value="OK"/>
                </form>
            </span>
        </div>
        <p><br></p>
        <div class="contain_sub">

            <?php			
			$pa=1;
			    if(isset($_GET['p']))
			    {
			        $pa=$_GET['p'];
			    }
			$pp=$pa-1;
			$ps=$pa+1;
            if(isset($tabQuestion))
            {
                paginateQuestion($tabQuestion,$pa);
            }
            else
            {
                echo "<h4>Rien à afficher</h4>";
            }
            ?>
	        
	    </div>

        <div class="div_nav">
            <?php if($pp>=1){?>
                <a href='index.php?origin=admin&action=listQuestion&p=<?=$pp?>' class='ipbtn float_l'>Précédent</a>
            <?php
            }
            if($ps<$nbP){
            ?>
                <a href='index.php?origin=admin&action=listQuestion&p=<?=$ps?>' class='ipbtn float_r'>Suivant</a>           
            <?php
            }
            ?>
    </div>
</div>