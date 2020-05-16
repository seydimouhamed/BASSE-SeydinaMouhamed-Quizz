<?php 
    $title = 'Profil'; 
?>

<?php ob_start(); ?>
        
    <?php require_once("view/commons/profil.php"); ?>

<?php $content_jeu = ob_get_clean(); ?>

<?php require_once("view/player/template_jeu.php"); ?>