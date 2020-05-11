<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="public/css/homeplayer.css">
<link rel="stylesheet" type="text/css" href="public/css/styleCheck.css">
<style type="text/css">
        .sc_lab
        {
        padding: 10px;
        background-color: thistle;
        border:2px dotted red;
        }
        .sc_label
        {
        color: royalblue;
        }
        .votre_sc
        {
            border-left:5px solid red;
        }
        .onglet
        {
                display:inline-block;
                
                margin-right:-4px;
                padding:3px;
               
                cursor:pointer;
                
        }
        .onglet_0
        {
                width: 47.5%;
                color: #3bc9db;
                background-color:#f8f9fa ;
                text-align: center;
             
        }
        .onglet_0_1
        {
                width: 47.5%;
                color: #3bc9db;
                background-color:#f8f9fa ;
                box-shadow: 0 -5px 5px -5px #f8f9fa;
             
        }
        .onglet_0_2
        {
                width: 47.5%;
                color: #3bc9db;
                background-color:#f8f9fa ;
            box-shadow: 0 -5px 5px -5px #f8f9fa;
             
        }
        .sdt_o
        {
            box-shadow: 0 -5px 5px -5px #f8f9fa;
        }
        .sdl_o
        {
            
             box-shadow: -5px 0 5px -5px #333;
        }
        .sdr_i
        {
            
        }
        .sdr_o
        {
                box-shadow: 5px 0 5px -5px #333;
        }
        .sdb_o
        {
            
            box-shadow: 0 5px 5px -5px #333;
        }

        .all{

                box-shadow: 0 0 5px #333;
        }
        .onglet_1   
        {
                background:white;
                text-align: center;
               border-top-right-radius:5px;
               border-top-left-radius:5px;
                box-shadow: 0 -5px 5px -5px #afadad/*top*/,5px 0 5px -5px #afadad/*droite*/,-5px 0 5px -5px #afadad/*left*/; 
                width: 48%;

        }
        .contenu_onglets
        {
                height: inherit;

        }
        .contenu_onglet
        {
                background-color:white;
                
                
                box-shadow: 0 5px 5px -5px #afadad/*top*/,5px 0 5px -5px #afadad/*droite*/,-5px 0 5px -5px #afadad/*left*/;     
                display:none;   
                border:none;
               border-radius:5px;
               height: inherit;
        }
        ul
        {
                margin-top:0px;
                margin-bottom:0px;
                margin-left:-10px
        }
        h1
        {
                margin:0px;
                padding:0px;
        }
        .systeme_onglets
        {
            height:100%;
        }
        .div_ss_score
        {
            width: 90%;
            margin-left: 5%;
            border:none;
            line-height: 2em;
            font-weight: bold;
            clear: both;

        }
        .spn_score.num0
        {
            border-bottom: 4px solid orange;
        }
        .spn_score.num1
        {
            border-bottom: 4px solid magenta;
        }
        .spn_score.num2
        {
            border-bottom: 4px solid lime;
        
        }
        .spn_score.num3
        {
            border-bottom: 4px solid red;
        }
        .spn_score .num4
        {
            border-bottom: 4px solid purple;
        }

        #returntop
        {
                color:#51bfd0;
                position: fixed;
                bottom: 25px;
                float: right;
                right: 18.5%;
                left: 77.25%;
                border:1px dotted red;
                background-color: thistle;
                width:50px;
                height:50px;
                text-align:center;
                border-radius: 50%;
                font-size:30px;

        }

        </style>   

<div class="body_box">
    <div class="box_menu">         
        <div class="systeme_onglets">
            <div class="onglets">
                <span class="onglet_0 onglet" id="onglet_quoi" onclick="javascript:change_onglet('quoi');"><small>Top scores</small></span>
                <span class="onglet_0 onglet" id="onglet_qui" onclick="javascript:change_onglet('qui');"><small>Mon meilleur Score</small></span>
                
            </div>
            <div class="contenu_onglets">
                <div class="contenu_onglet" id="contenu_onglet_quoi">
                    <?php 
                        $fn="firstname";
                        $ln="lastname";
                        foreach ($topScore as $i => $k) {
                    ?>
                        <div class="div_ss_score">
                            <h3>  <span class="float_l"><?php if($k[$fn]==$userInfo[$fn] && $k[$ln]==$userInfo[$ln]){ echo "<b class='votre_sc'>Vous</b>";}else{ echo $k['firstname'] ; ?>&nbsp;&nbsp;<?php echo $k['lastname'];}?> </span><span class="float_r spn_score num<?=$i?>"><?= $k['score']." "?>pts</span> </h3>
                        </div>
                    <?php }?>
                </div>
                <div class="contenu_onglet" id="contenu_onglet_qui">
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <h1><?=$userInfo['score'].' ';?>pts</h1>
                </div>
            </div>
        </div>
        <?php if(isset($_GET['action']) && $_GET['action']!=='pl'){?>                    
        &nbsp; &nbsp;<a href="index.php?origin=player&action=pl"><button class="ipbtn " >Rejouer</button></a> 
        <?php }else {?>                    
        &nbsp; &nbsp;<a href="index.php?origin=player&action=finjeu"><button class="ipbtn " >Quitter la partie </button></a>
        <?php }?>
    </div>
        
    <div class="rotate_question">
 
        <?= $content_jeu ?>
       
    </div>
</div>
<script type="text/javascript">

    var anc_onglet = 'quoi';
    change_onglet(anc_onglet);

    function change_onglet(name)
    {
        document.getElementById('onglet_'+anc_onglet).className = 'onglet_0 onglet';
        document.getElementById('onglet_'+name).className = 'onglet_1 onglet';
        document.getElementById('contenu_onglet_'+anc_onglet).style.display = 'none';
        document.getElementById('contenu_onglet_'+name).style.display = 'block';
        anc_onglet = name;
    }


    // function validate() 
    // {
    //     var form = document.getElementById("form");
    //     var typ = document.getElementsByName('typ')[0].value;
    //     if(typ==="ct")
    //     {
    //         return true;
    //     }
    //     var checked = 0;

    //     //Reference all the CheckBoxes in Table.
    //     var chks = form.getElementsByClassName("ck");

    //     //Loop and count the number of checked CheckBoxes.
    //     for (var i = 0; i < chks.length; i++) 
    //     {
    //         if (chks[i].checked) 
    //         {
    //             checked++;
    //         }
    //     }

    //     if (checked > 0 ) 
    //     {
    //         return true;
    //     } 
    //     else 
    //     {
    //         return false;
    //     }
    // }
</script>
<?php $content_container = ob_get_clean(); ?>

<?php require("view/commons/template_container.php"); ?>