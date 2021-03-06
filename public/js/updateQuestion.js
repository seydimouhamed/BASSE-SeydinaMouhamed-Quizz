var dataInitial={};

var checks=document.getElementsByClassName('mod')
for(let c of checks)
{
    c.addEventListener("click",function(e){
        let idf=c.value;
        if(e.target.checked==true)
        {
            initiateForm(idf)
        }else
        {
            initialState(idf);
        }
    });
}

function updateListener()
{
    var checks=document.getElementsByClassName('mod')
    for(let c of checks)
    {
        c.addEventListener("click",function(e){
            let idf=c.value;
            if(e.target.checked==true)
            {
                initiateForm(idf)
            }else
            {
                initialState(idf);
            }
        });
    }
}

function initialState(id)
{
    document.getElementById(id).innerHTML=dataInitial[id];
    
}

function initiateForm(id)
{
    var divTarget=document.getElementById(id);
    var intialData=divTarget.innerHTML;
        dataInitial[id]=intialData;

    var form=document.createElement("form");
        form.setAttribute("id","form_"+id);
        form.setAttribute("onsubmit","return sendData('"+id+"','form_"+id+"')");

    var div_reponse=document.createElement('div');
        div_reponse.setAttribute('id','div_reponse'+id)

    var inQuestion=document.createElement("textarea");
        //inQuestion.setAttribute('type','text');
        inQuestion.setAttribute("name","question");
        inQuestion.setAttribute('value',"question")
        inQuestion.setAttribute('class',"stlIp inQuestion")
    //creer le input number
    var inScore=document.createElement("input");
        inScore.setAttribute('type','number');
        inScore.name="score";
        inScore.setAttribute('class',"stlIp")
    var inSelect=document.createElement("select");
        inSelect.name="type";
        inSelect.setAttribute('class',"stlIp")
        inSelect.id="div_reponse"+id+"Select";
        inSelect.setAttribute("onchange","selectChange('div_reponse"+id+"')")
    var opCm = document.createElement("option");
        opCm.value="cm";
        opCm.text="Choix Multiple"
    var opCs = document.createElement("option");
        opCs.value="cs";
        opCs.text="Choix Simple";
    var opCt = document.createElement("option");
        opCt.value="ct";
        opCt.text="Choix Texte"
    // append options dans le select
        inSelect.appendChild(opCm);
        inSelect.appendChild(opCs);
        inSelect.appendChild(opCt);
    
    //create du button ajouter champ! 
    var btnAdd=document.createElement('input');
    btnAdd.setAttribute("class","btn_gene");
    btnAdd.setAttribute("type","button");
    btnAdd.value=" ";
    btnAdd.setAttribute("onclick","addChamp('div_reponse"+id+"','"+id+"')");
        
    //Mettre les données dans les éléments
      let qcm=retrieveDataQ(id);
      inQuestion.value=qcm[1];
      inScore.value=qcm[2];
      inSelect.value=qcm[3];


    //mettre les éléments dans le div
    divTarget.innerHTML="";
    form.appendChild(inQuestion);
    form.appendChild(inScore);
    form.appendChild(inSelect);
    form.appendChild(btnAdd);
    if(qcm[3]=="cm" || qcm[3]=="cs" )
    {
        for(let i=0;i< qcm[4].length;i++)
        {
            let div_cont=document.createElement('span');
                div_cont.setAttribute('class','w_96')
                div_cont.setAttribute('id','id_'+id+'_'+i)
            let repIn=document.createElement("input");
                repIn.setAttribute('type',"text");
                repIn.setAttribute('class','stlIp');
                repIn.value=qcm[4][i];
                repIn.setAttribute("Name", "reponse_" + i);
            let repCk=document.createElement('input');
            repCk.setAttribute("Name", "check[]" );
            repCk.setAttribute("value", i );
            if(qcm[3]=="cm")
            {
                repCk.setAttribute('type',"checkbox");
            }
            else
            {
                repCk.setAttribute('type',"radio");
            }
            let btnRem=document.createElement('button')
               btnRem.textContent="."
                btnRem.setAttribute("class","btn_remove")
                btnRem.setAttribute('id','rv_'+id+'_'+i)
                btnRem.setAttribute("onclick", "removeElement('div_reponse"+id+"','id_"+id+"_"+i+"')");
                if(inArray(i+1,qcm[5]))
                {
                    repCk.checked=true
                }
                div_cont.appendChild(repIn);
                div_cont.appendChild(repCk);
                div_cont.appendChild(btnRem);
                div_reponse.appendChild(div_cont);
                
        }

    }
    else
    {
        let repIn=document.createElement("input");
        repIn.setAttribute('type','text')
        repIn.setAttribute('name','breponses[]')
        repIn.value=qcm[4]
        div_reponse.appendChild(repIn)
    }

    var btnSbmit=document.createElement('button');
        btnSbmit.setAttribute('type','submit');
        btnSbmit.name="updateQuestion";
        btnSbmit.value="ok";
        btnSbmit.textContent="Changer";
        
    form.appendChild(div_reponse);
    form.appendChild(btnSbmit)
    divTarget.appendChild(form);
}

function retrieveDataQ(id)
{
    var qcm= [];
    var reponses = [];  
    var brep= [];
    var qtn=document.getElementById("qts_"+id).innerText;
    var sc=document.getElementById('data_'+id).getAttribute("score");
    var ty=document.getElementById('data_'+id).getAttribute("typeChoix");
    var nbrRep=document.getElementById('data_'+id).getAttribute("nbrRep");

    if(nbrRep!=1)
    {
        for(let i=1;i<=nbrRep;i++)
        {
            var reponse=document.getElementById("rep_"+id+"_"+i).innerText;
            reponses.push(reponse);
             let ch=document.getElementById("chk_"+id+"_"+i)
              if(ch.checked)
              {
                  brep.push(i);
              }
        }
    }
    else
    {

        var repon=document.getElementById("rep_"+id).value;
        reponses.push(repon.trim());
    }

    qcm.push(id,qtn,sc,ty,reponses,brep);

    return qcm;
}


function inArray(val, arr) {
    var length = arr.length;
    for(var i = 0; i < length; i++) {
        if(arr[i] == val) return true;
    }
    return false;
}
var i=10;


function addChamp(idtarget,id)
{

    var type=document.getElementById(idtarget+"Select").value
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
            i++;
            
            y.setAttribute("Name", "reponse_" + i);
            y.setAttribute('onkeyup','removeErCk()');
            y.setAttribute("error0", "error_" +(i+3));
                r.appendChild(y);
            var c = document.createElement("INPUT");
                c.setAttribute("class", "ck");
                c.setAttribute("Name", "check[]" );
                c.setAttribute("onclick", "removeErCk()" );

                //removeErCk()
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
            g.setAttribute("onclick", "removeElement('div_reponse"+id+"','id_" + id +"_"+i+"')");
            r.appendChild(g);
            //
            //creation du champ erreur
            var err=document.createElement("small");
            err.setAttribute("id", "error_" +(i+3));
            err.setAttribute("class", "error error_rep");
            r.appendChild(err);
            //
            r.setAttribute("id", "id_" + id+"_"+i);
        document.getElementById(idtarget).appendChild(r);

    }
}



/*
-----------------------------------------------------------------------------
Functions pour supprimer tout les champs!
------------------------------------------------------------------------------
*/
function resetElements(id_div)
{
    document.getElementById(id_div).innerHTML = '';
    //disabledBtn()
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
    }
    else
    {
    	return false;
    }
}

/*
---------------------------------------------

fonction quand l'élément sélectionné change
---------------------------------------------

*/


function selectChange(id)
{

    resetElements(id);
    var typ = document.getElementById(id+"Select").value
    if(typ==="ct")
    {
     document.getElementById(id).innerHTML="<span class='al_c'><label>Reponse &nbsp; &nbsp;</label> <input type='text' class='stlIp' onkeyup='removeErrorTxt(\"errortxt\")' error='errortxt' name='breponses[]' required /></span> <br> <small id='errortxt' class='error'></small>";
    }
}
/*
---------------------------------------------
fonction quand l'élément sélectionné change FIN
---------------------------------------------
*/

function sendData(id,idForm)
{
  if (!validate()) {
      alert(" les données de sont pas valide!");
    //document.getElementById("txtHint").innerHTML = "";
    return false;
  } 
  else {
 
    //var form=document.getElementById(idForm);
    var elements = document.getElementById(idForm).elements;
    var data ="id="+id+"&";
    var error=false;
    var comptCk=0;
    var comptRep=0;
    let type= elements.namedItem("type").value;
    for(var i = 0 ; i < elements.length ; i++)
    {
        var item = elements.item(i);
         
         if(item.type=="checkbox" || item.type=="radio")
         {
             
            if(item.checked)
            {
                data +=[item.name]+"="+ item.value;
                comptCk++;
            }
         }
         else
         {
            data +=[item.name]+"="+ item.value; 
            if(item.getAttribute('cp')=="cp" && item.value.trim())
            {
                
                comptRep++;
            }
         }

        if((i+1)!=elements.length )
        {
            data+="&";
        }
    }
// validation 
    if(type=='cm' || type=='cs')
    {
        if(comptRep<2 || comptCk<1)
        {
            document.getElementById('error_glob_'+id).innerText="Veuillez compléter le formulaire";
            return false;
        }
    }

   // document.getElementById(idForm).innerHTML = data;
        
   var ajx = new XMLHttpRequest();
    ajx.onreadystatechange = function () {
        if (ajx.readyState == 4 && ajx.status == 200) {
            let data = ajx.responseText;
            replaceAfterChange(id,data);
            document.getElementById('error_glob_'+id).innerText="";
            //document.getElementById(idForm).innerHTML = ajx.responseText;
        }
    };
    ajx.open("POST", "index.php?origin=admin&updateQuestion=on", true);
    ajx.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajx.send(data);
    
    
    return false;
   }
}


function validate()
{
    return true;
}


function replaceAfterChange(id,data)
{
    document.getElementById("q_check_"+id).checked=false ;
    let dataObj=JSON.parse(data)
    var d=document.getElementById(id);
    let type=dataObj['type'];
    d.innerHTML="";
    if(type=="cm")
    {
        d.innerHTML+='	<input type="hidden" id="data_'+id+'" typeChoix="'+dataObj['type']+'" score="'+dataObj['score']+'" nbrRep="'+dataObj['reponses'].length+'"/>'
                +'&nbsp;&nbsp;<strong class="sm_font13 mg_2" id="qts_'+id+'">'+ dataObj['question'] +'</strong>';
        for(let i=0;i< dataObj['reponses'].length;i++)
        {
            let rep=dataObj['reponses'][i];
           d.innerHTML+='<label class="c_rep sm_font" id="rep_'+id+'_'+i+'">'+rep
               if(inArray(i+1,dataObj['breponses']))
                { 
                    d.innerHTML +='<input type="checkbox" id="chk_'+id+'_'+i+'" disabled  name="rep_user[]" value="" checked /><span class="check" ></span></label>'    
                    
                }
                else
                {
                d.innerHTML +='<input type="checkbox" id="chk_'+id+'_'+i+'" disabled  name="rep_user[]" value="" /><span class="check" ></span></label>'
                }
        }
    }else if(type=="cs")
    {
        d.innerHTML+='	<input type="hidden" id="data_'+id+'" typeChoix="'+dataObj['type']+'" score="'+dataObj['score']+'" nbrRep="'+dataObj['reponses'].length+'"/>'
                +'&nbsp;&nbsp;<strong class="sm_font13 mg_2" id="qts_'+id+'">'+ dataObj['question'] +'</strong>';
        for(let i=0;i< dataObj['reponses'].length;i++)
        {
            let rep=dataObj['reponses'][i];
           d.innerHTML+='<label class="c_rep sm_font" id="rep_'+id+'_'+i+'">'+rep
               if(inArray(i+1,dataObj['breponses']))
                { 
                    d.innerHTML +='<input type="radio" id="chk_'+id+'_'+i+'" disabled  name="rep_user[]" value="" checked /><span class="checkmark" ></span></label>'    
                    
                }
                else
                {
                d.innerHTML +='<input type="radio" id="chk_'+id+'_'+i+'" disabled  name="rep_user[]" value="" /><span class="checkmark" ></span></label>'
                }
        }
    }
    else
    {
        d.innerHTML+='	<input type="hidden" id="data_'+id+'" typeChoix="'+dataObj['type']+'" score="'+dataObj['score']+'" nbrRep="1"/>'
                +'&nbsp;&nbsp;<strong class="sm_font13 mg_2" id="qts_'+id+'">'+ dataObj['question'] +'</strong>';
        d.innerHTML +='<input class="iptxt w80" disabled id="rep_<?=$i?>"  type="text" name="rep_user[]" value="'+dataObj['breponses'][0]+'"/>'
        
    }
}