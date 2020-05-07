<?php 
    $title = 'Fin Jeu'; 
?>

<?php ob_start(); ?>
        
    <?php
                        $number=1;
                        $score=0;
                        $scoreT=0;
                        foreach($tabT as $tabuq){ 
                        $typ=$tabuq['type'];
                        $urep=$tabuq['currep'];
                        $scq=$tabuq['score'];
                        $breponses=$tabuq['breponses'];
                        $scoreT=$scoreT+$scq;
                        echo "<div class='head_q'><h4>$number.".$tabuq["question"]."</h4></div>";
                        echo"<div class='cq_q'>";
                            if($typ=="cs")
                            {
                                $rep=$tabuq['reponses'];
                                $num=1;
                                foreach($rep as $u)
                                {
                                    echo '<label class="c_rep"><xmp>'.$u.'</xmp>
                                            <input type="radio" disabled name="rep_user'.$number.'[]" value="'.$num.'"';
                                            if(!empty($urep) || in_array($num,$urep))
                                            { 
                                                 echo "checked"; 
                                            }
                                            echo '  >
                                            <span class="checkmark"></span>
                                        </label>';
                                    $num++;
                                }

                            }
                            elseif($typ=="cm")
                            {
                                $rep=$tabuq['reponses'];
                                $num=1;
                                foreach($rep as $u)
                                {
                                    echo '<label class="c_rep"><xmp>'.$u.'</xmp>
                                            <input type="checkbox" disabled  name="rep_user[]" value="'.$num.'"';
                                            if(!empty($urep) || in_array($num,$urep))
                                            {  
                                                echo "checked"; 
                                            }
                                            echo '>
                                            <span class="check" ></span>
                                        </label>';
                                    $num++;
                                }
                            }
                            else
                            {
                                echo '<input class="iptxt" disabled  type="text" name="rep_user[]" value="';
                                if(!empty($urep))
                                { 
                                    echo $urep[0];
                                }
                                echo '" required>';
                            }
                            if(empty(array_diff($breponses,$urep)))
                            {
                                $score=$score+$scq;
                                echo "<div class='markv juste'>&#10004;</div>";
                            }
                            else
                            {
                                echo "<div class='markv'>&#10060;</div>";
                            }
                        echo"</div>";
                        $number++;
                        }
                        $newScore=$score;
                       
                       echo "<h1 class='sc_lab'>vous avez <i class='sc_label'> $score / $scoreT pts</i></h1>"; 
                        
                        ?>
                    <script>
                        window.onload = function() 
                        {
                            setTimeout(function(){ 
                                location.reload();
                }, 2000);
            }
                        }
                    </script>

<?php $content_jeu = ob_get_clean(); ?>

<?php require("view/player/template_jeu.php"); ?>