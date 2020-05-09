
    document.getElementById("type").addEventListener("change",function(e)
    {
       resetElements();
       var typ = document.getElementById('type').value
       if(typ==="ct")
       {
        document.getElementById("div_reponse").innerHTML="<span class='al_c'><label>Reponse &nbsp; &nbsp;</label> <input type='text' class='stlIp' onkeyup='removeErrorTxt(\"errortxt\")' error='errortxt' name='breponses[]' /></span> <br> <small id='errortxt' class='error'></small>";
        }
        removeErCk()
    }); 
    
    
    function removeErrorTxt(id)
    {
       document.getElementById(id).innerHTML="";
    }

    //suprimer l'erreur quand on selectionne un check ou radio
    function removeErCk()
    {
       document.getElementById("general_error").innerHTML="";
    }
    

    function disabledBtn()
    {
        var btn= document.getElementById("btn_gene");
        var num=numberChamp();
        if(num>=10)
        {
            btn.setAttribute("disabled","true");
        }
        else
        {
            btn.removeAttribute("disabled");  
        }

    }



function numberChamp()
{
	const champs=document.getElementsByTagName("input");
	var number=0;
	for(let champ of champs)
	{
		if(champ.hasAttribute("cp"))
		{
			number++;
		}

	}

	return number;
}


function validateTextReponse()
{
    const inputs = document.getElementsByTagName("input");
    var nbrCpNonvide=0;
    for(let input of inputs)
    {
        if(input.hasAttribute("error0"))
        {
            if(input.value)
            {
                nbrCpNonvide++
            }
        }
    }

    return nbrCpNonvide >=2;
    
}


function validateScQuest()
{
    var score= document.getElementById("score").value;
    var question = document.getElementById("question").value;
    var error=false;

   if(!Number.isInteger(+score))
   {
        document.getElementById('error_2').innerText="veuillez mettre un nombre entier positif";
       error= true; 
   }
   if(!question)
   {
    document.getElementById('error_1').innerText="la question ne doit pas être vide";
     error=true;
        
   }
    

   return !error;
        
}

function validate()
{
   var form = document.getElementById("mainform");
   var typ = document.getElementById('type').value
   var errorep=false;
   //si c'est un choix text va obieit a la validation des champs vides
   
   if(typ=="cm" || typ=='cs')
   {
     
            var checked = 0;

            //Reference a tous les checkboxs
            var chks = form.getElementsByClassName("ck");

            //Pour compter le nombre de checkboxs.
            for (let chk of chks) 
            { 
                if (chk.checked) {
                    checked++;
                }
            }
            //appel de la fonction qui determine si nombre de input ecrit est > a 2
            var tv=validateTextReponse();

            
            if (checked <= 0 || !tv) 
            {
                if(checked <= 0)
                {
                        document.getElementById("general_error").innerHTML="veuillez cocher un champ <br>";
                }
                if(!tv)
                {
                        document.getElementById("general_error").innerHTML+="il faut au moins remplir deux reponses"; 
                }

                errorep = true;
            }

    }


    return validateScQuest() && !errorep;
}

    
var i = 0; /* Set Global Variable i */
function increment()
{
    i += 1; /* Function pour incrémenter automatiquement. */
}
/*
---------------------------------------------

Function to Remove Form Elements Dynamically
---------------------------------------------

*/
function removeElement(parentDiv, childDiv){
    if (childDiv == parentDiv)
    {
    	return ;
    }
    else
    if (document.getElementById(childDiv))
    {
    	var child = document.getElementById(childDiv);
    	var parent = document.getElementById(parentDiv);
        parent.removeChild(child);
        //appéle la function de génération de labels reponse 
            genRepNumb();
        //appele de function qui limite les champs en desactivant le bouton
            disabledBtn()
    }
    else
    {
    	return false;
    }
}
/*
----------------------------------------------------------------------------

Functions that will be called upon, when user click on the Name text field.

----------------------------------------------------------------------------
*/

document.getElementById("btn_gene").addEventListener("click",function(e)
    {
        var type=document.getElementById("type").value
        if(type==="cm" || type==="cs")
         {
             //r=span, y=input, l=label, g=bouton de suppression, c=check ou radio
            //creattion de span qui ce contenir la ligne r=span
            var r = document.createElement('span');
                    r.setAttribute("class", "w_96");
            // creattion du label
            var l = document.createElement('LABEL');
                l.setAttribute("class", "lab");
            //creation du input y=input
            var y = document.createElement("INPUT");
                y.setAttribute("type", "text");
                y.setAttribute("class", "stlIp");

                //ajouter le label
                r.appendChild(l);
                    y.setAttribute("cp", "cp");
                    
                
                var g = document.createElement("input");
                g.setAttribute("type", "button");
                g.setAttribute("class", "btn_remove");
                //pour générer le i
                increment();
                
                y.setAttribute("Name", "reponse_" + i);
                y.setAttribute('onkeyup','removeErCk()');
                y.setAttribute("error0", "error_" +(i+3));
                    r.appendChild(y);
                var c = document.createElement("INPUT");
                    c.setAttribute("class", "ck");
                    c.setAttribute("Name", "check[]" );
                    c.setAttribute("onclick", "removeErCk()" );
                    removeErCk()
                    if(type==="cm")
                    {
                        c.setAttribute("type", "checkbox");
                    }
                    else if(type==="cs")
                    {
                        c.setAttribute("type", "radio");
                    }
                    c.setAttribute("value", i);
                    r.appendChild(c);
                //bouton d'effacement
                g.setAttribute("onclick", "removeElement('div_reponse','id_" + i + "')");
                r.appendChild(g);
                //
                //creation du champ erreur
                var err=document.createElement("small");
                err.setAttribute("id", "error_" +(i+3));
                err.setAttribute("class", "error error_rep");
                r.appendChild(err);
                //
                r.setAttribute("id", "id_" + i);
            document.getElementById("div_reponse").appendChild(r);
        
            //appéle la function de génération de labels reponse 
              genRepNumb();
            // appele de function de limitation des chmaps   
              disabledBtn();
        }
    });


    function genRepNumb()
    {
        var form = document.getElementById("mainform");
        var labs=form.getElementsByClassName("lab")
        for (var i = 0; i < labs.length; i++) 
        { 
            labs[i].innerHTML="Reponse "+(i+1);
        }
    }


/*
-----------------------------------------------------------------------------
Functions pour supprimer tout les champs!
------------------------------------------------------------------------------
*/
    function resetElements()
    {
        document.getElementById('div_reponse').innerHTML = '';
        disabledBtn()
        
    }
