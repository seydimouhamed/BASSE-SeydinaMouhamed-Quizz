<?php $title = 'Home admin';
?>

<?php ob_start();
    include("view/admin/$page.php"); 
 $content_admin = ob_get_clean(); ?>

<?php require_once("view/admin/template_admin.php"); ?>