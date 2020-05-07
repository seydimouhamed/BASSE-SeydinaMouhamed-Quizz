<?php $title="S'inscrire"?>
<?php 
ob_start(); 
?>
<div class="content_inscription">
    <?php
    $msg_txt="Pour tester votre niveau de culture générale";
    $msg_avt="du joueur";
    $profil="user";
    include("view/commons/formInscription.php");
    ?>
</div>
<?php
$content = ob_get_clean(); 

?>

<?php require_once('view/commons/template.php'); ?>