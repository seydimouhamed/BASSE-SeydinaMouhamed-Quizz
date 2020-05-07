<link rel="stylesheet" type="text/css" href="public/css/styleBreadcrumb.css">
        
<div class="contain_pl">
        
        <div class="div_head">
            <span>
                <form id="form-number" onsubmit="return isNumbervalide()" action="index.php?origin=admin" method="POST">
                    Nbr de question/jeu
                    <input type="text"id="nombre" class="inNumber" name="nbrQJ"  value="<?=$nbrQJ ?>"/>
                    <input type="submit" name="rnbrQuestion" value="OK"/>
                </form>
            </span>
        </div>
            <span id="error_number"><br></span>
        <br><br>
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
<script type="text/javascript" src="./public/js/validateNumber.js"></script>
<script type="text/javascript" src="./public/js/updateQuestion.js"></script>