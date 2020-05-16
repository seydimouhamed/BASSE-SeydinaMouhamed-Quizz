
		<link rel="stylesheet" type="text/css" href="public/css/styleCQ.css">
<div class="contain_pl">
	    <h2 class="h2">Parametrer votre question</h2>
	    <div class="contain_sub">
		        <form method="POST" id="form" action="index.php?origin=admin&action=cq" onsubmit="return validate();">
		            <div class="div_question">
		                <label>Questions</label>
		                <textarea name="question" required></textarea>
		            </div>
		            <div class="div_score">
		                <label>Nbr de point </label><input type="number" name="score" required/>
		            </div>
		            <div class="div_type">
		                <label>Type de reponse </label>
		                <select name="type" id="type" onchange="removeAll();">
		                    <option value="cm">choix multiple</option>
		                    <option value="cs">choix simple</option>
		                    <option value="ct">choix text</option>
		                </select>
		                <span><label class="btn_gene" id="btn_gene" ><a class="a" href="javascript:create_champ(1)" >&nbsp;</a></label></span>
		            </div>
		            <br>
		            <div class="div_reponse" >
		            <br>
		                <span id="leschamps_1"></span>
		            </div>
		            <input type="submit" class="btn_enr" name="submit_question" value="Enregistrer"/>
		        </form>
	    </div>
</div>

<script type="text/javascript" src="public/js/validationInput.js"></script>
<script>
function numberChamp()
{
	const champs=document.getElementsByTagName("input");
	var number=0;
	for(champ of champs)
	{
		if(champ.hasAttribute("champG"))
		{
			number++;
		}

	}

	return number;
}
function validate()
{
   var form = document.getElementById("form");
   var typ = document.getElementById('type').value
   if(typ==="ct")
   {
	   return true;
   }
   var checked = 0;

   //Reference all the CheckBoxes in Table.
   var chks = form.getElementsByClassName("ck");

   //Loop and count the number of checked CheckBoxes.
   for (var i = 0; i < chks.length; i++) 
   {
	   if (chks[i].checked) {
		   checked++;
	   }
   }

   if (checked > 0) 
   {
	   return true;
   } else 
   {
	   return false;
   }
};

function removeAll()
{
 //var nbrLigne = document.getElementsByTagName('champ').length;
  // document.getElementById('demo').innerHTML ="holla ";
  document.getElementById("leschamps_1").innerHTML="";
  document.getElementById('btn_gene').innerHTML =
	   '<a href="javascript:create_champ(1)">+</a>';
}

function create_champ(i)
{
   
  var choix = document.getElementById('type').value
	var i2 = i + 1;
	if(numberChamp()<5)
	{
	
	   if(choix==="cm")
	   {
		   document.getElementById('leschamps_'+i).innerHTML = 
		   '<champ class="champ"><span id="ligne_'+i+'"><input class="stlIp" champG="'+i+'" type="text" required name="reponses[]" id="fichier_'+i+'"><input type="checkbox" class="ck" name="breponses[]" value='+i+' id="fichier_'+i+'"><input type="button" class="btn_remove" value="&nbsp;" id="boutton_'+i+'" onclick="suppr('+i+')"/><br /></span></champ></span><br><span  id="leschamps_'+i2+'"></span>'; 
		   document.getElementById('btn_gene').innerHTML =
		   '<a class="a" href="javascript:create_champ('+i2+')"></a>';
	   }
	   else if(choix==="cs")
	   {
		   
		   document.getElementById('leschamps_'+i).innerHTML = 
		   '<champ class="champ"><span id="ligne_'+i+'"><input class="stlIp" champG="'+i+'" type="text" name="reponses[]" id="fichier_'+i+'" required><input type="radio" class="ck" name="breponses[]" value='+i+' id="radio_'+i+'"><input class="btn_remove" type="button" value="&nbsp;" id="boutton_'+i+'" onclick="suppr('+i+')"/><br /></span></champ></span><br><span  id="leschamps_'+i2+'"></span>'; 
		   document.getElementById('btn_gene').innerHTML =
		   '<a class="a" href="javascript:create_champ('+i2+')"></a>';
	   }
	   else if(choix==="ct")
	   {
	   document.getElementById('leschamps_'+i).innerHTML = 
	   '<champ class="champ"><span id="ligne_'+i+'"><input class="stlIp" type="text" name="breponses[]" id="txt_reponse" required><br /></span></span></champ>'; 
	   }

   	} 
}
function suppr(i){ document.getElementById("ligne_"+i).innerHTML=""; } 

</script>