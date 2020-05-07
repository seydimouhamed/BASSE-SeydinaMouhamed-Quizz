<?php 
    $title = 'JOUER'; 
?>

<?php ob_start(); ?>
   
        <div class="box_q">
                <h2>Question <?= $cp.'/'.$np ?></h2>
                <h3><?php echo $tabuq['question'];?></h3>
                        </div>
                        <div class="box_score"><?= $tabuq['score'] ?> pts</div>
                        <div class="box_rep">
                                <!--________________________________________________-->

                                <form action="index.php?origin=player&action=pl" id="form" onsubmit="return validate();" method="POST">
                                            <?php 
                                                $typ=$tabuq['type'];
                                                $urep=$tabuq['currep'];
                                            ?>
                                            <input type='hidden' name='typ'  value='<?= $typ ?>'/>
                                            <?php   if($typ=="cs")
                                                {
                                                    $rep=$tabuq['reponses'];
                                                    $num=1;
                                                    foreach($rep as $u)
                                                    {
                                            ?>
                                                    <label class="c_rep"><code><?= $u ?></code>
                                                                <input type="radio" class="ck" name="rep_user[]" value="<?=$num ?>"
                                                            <?php if(!empty($urep) && in_array($num,$urep))
                                                                { 
                                                                        echo "checked";
                                                                }?>
                                                                />
                                                                <span class="checkmark"></span>
                                                            </label>
                                            <?php            $num++;
                                                    }

                                                }
                                                elseif($typ=="cm")
                                                {
                                                    $rep=$tabuq['reponses'];
                                                    $num=1;
                                                    foreach($rep as $u)
                                                    {
                                                    echo '<label class="c_rep"><xmp>'.$u.'</xmp>
                                                                <input type="checkbox" class="ck" name="rep_user[]" value="'.$num.'"';
                                                                if(!empty($urep) && in_array($num,$urep))
                                                                { 
                                                                        echo "checked";
                                                                }
                                                                echo '>
                                                                <span class="check"></span>
                                                            </label>';
                                                        $num++;
                                                    }
                                                }
                                                else
                                                {
                                                    echo '<input class="iptxt" type="text" name="rep_user[]" value="';
                                                    if(!empty($urep))
                                                    { 
                                                        echo $urep[0];
                                                    }
                                                    echo '" required>';
                                                }
                                            ?>
                                        </div>
                                        <?php  echo"<input type='hidden' name='cp' value='$cp'/>";?>
                                        <div class="c_btn">
                                            <input type="submit"<?php if($cp==1){ echo 'disabled';}?>  class="ipbtn float_l" name="prec" value="Précédent"/>
                                            <input type="submit"<?php if($cp!=$np){ echo 'name="suiv" value="Suivant"';}else{ echo 'name="term" value="Terminé"';}?> onclick="validateCheck();" class="ipbtn float_r" />
                                        </div>
                                 </form>

       <!--___________________________________________________________________________-->                             
                    </div>

<?php $content_jeu = ob_get_clean(); ?>

<?php require("view/player/template_jeu.php"); ?>