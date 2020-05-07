
// Get the modal
var modal1 = document.getElementById("myModal1");

// Get the button that opens the modal
var btn1 = document.getElementById("myBtn1");

// Get the <span> element that closes the modal
var span1 = document.getElementsByClassName("close1")[1];

// When the user clicks the button, open the modal 
btn1.onclick = function() {
  modal1.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal1.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal1) {
    modal1.style.display = "none";
  }
}



function changeStatut(ind)
{
    document.getElementById('ref_id').href="index.php?origin=admin&changeStatut="+ind;
    
    modal1.style.display = "block";

document.getElementById('id_title').innerHTML='Changer Statut';
document.getElementById('id_msg').innerHTML="Vous étes sur de changer le statut du Joueur";

}

function removeUser(ind)
{
    document.getElementById('ref_id').href="index.php?origin=admin&removePlayer="+ind;
    
    modal1.style.display = "block";

document.getElementById('id_title').innerHTML='ALERT!!';
document.getElementById('id_msg').innerHTML="Vous étes sur de vouloir supprimer cet utilisateur";

}