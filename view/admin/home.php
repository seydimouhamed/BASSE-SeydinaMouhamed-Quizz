<?php $title = 'Home admin'; ?>

<?php ob_start(); ?>
<h1>Page Admin</h1>
<?php $content_container = ob_get_clean(); ?>

<?php require("view/commons/template_container.php"); ?>