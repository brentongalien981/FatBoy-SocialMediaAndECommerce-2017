<?php // require_once("../private/includes/initializations.php"); ?>
<?php // require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php // include(PUBLIC_PATH . "/_layouts/header.php"); ?>
<?php include("_layouts/header.php"); ?>





<?php
echo "tae fatboy<br>";

?>






<?php
// TODO: LOG
if (MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::show_debug_message();
    MyDebugMessenger::clear_debug_message();
}
?>








<link href="_styles/header.css" rel="stylesheet" type="text/css" />
<link href="_styles/index.css" rel="stylesheet" type="text/css">





<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += " / home";
</script>





<?php // include_layout_template('footer.php'); ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
