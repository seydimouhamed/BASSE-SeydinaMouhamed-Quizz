
//document.getElementById('form-number').addEventListener("submit"
function isNumbervalide()
{
    var  nombre=document.getElementById('nombre').value;
    if(!nombre || !Number.isInteger(+nombre))
    {
        document.getElementById('error_number').innerText="Veuillez entrer un nombre";
        return false;
    }else if(nombre<5)
    {
        document.getElementById('error_number').innerText="Le nombre doit etre supérieur ou égal a 5";
        return false
    }
return true ;
}