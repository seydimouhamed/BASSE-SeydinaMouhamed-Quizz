
    document.getElementById("type").addEventListener("change",function(e)
    {
       resetElements();
       var typ = document.getElementById('type').value
       if(typ==="ct")
       {
        document.getElementById("div_reponse").innerHTML="<span class='al_c'><label>Reponse &nbsp; &nbsp;</label> <input type='text' class='stlIp' name='breponses[]' /> </span>"
       }
    });   
    

    function disabledBtn()
    {
        var btn= document.getElementById("btn_gene");
        var num=numberChamp();
        if(num>=5)
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
function validate()
{
   var form = document.getElementById("mainform");
   var typ = document.getElementById('type').value
   if(typ==="ct")
   {
	   return true;
   }
   var checked = 0;

   //Reference a tous les checkboxs
   var chks = form.getElementsByClassName("ck");

   //Poru compter le nombre de checkboxs.
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
       document.getElementById("general_error").innerHTML="veuillez cocher un champ";
	   return false;
   }
};
    
var i = 0; /* Set Global Variable i */
function increment()
{
    i += 1; /* Function for automatic increment of field's "Name" attribute. */
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
    function generateInputs()
    {
        var type=document.getElementById("type").value
        if(type==="cm" || type==="cs")
         {
            //creattion de span qui ce contenir la ligne
            var r = document.createElement('span');
                    r.setAttribute("class", "w_96");
            // creattion du label
            var l = document.createElement('LABEL');
                l.setAttribute("class", "lab");
            //creation du input
            var y = document.createElement("INPUT");
                y.setAttribute("type", "text");
                y.setAttribute("class", "stlIp");

                //ajouter le label
                r.appendChild(l);
                    y.setAttribute("cp", "cp");
                    
                
                var g = document.createElement("input");
                g.setAttribute("type", "button");
                g.setAttribute("class", "btn_remove");
                increment();
                //l.innerHTML = 'Reponse '+i;
                y.setAttribute("Name", "reponse_" + i);
                y.setAttribute("error", "error_" +(i+3));
                    r.appendChild(y);
                var c = document.createElement("INPUT");
                    c.setAttribute("class", "ck");
                    c.setAttribute("Name", "check[]" );
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
        // else
        // {
        //     y.setAttribute("Name", "reponse" );
        //     r.appendChild(y); 
        // }
    }


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

Functions that will be called upon, when user click on the Reset Button.

------------------------------------------------------------------------------
*/
    function resetElements()
    {
        document.getElementById('div_reponse').innerHTML = '';
        disabledBtn()
        
    }
