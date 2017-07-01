<?php require_once("../../_layouts/header.php"); ?>




<!--For app debug messenger initialization.-->
<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>







<link href="<?php echo LOCAL . "/public/_styles/search/index.css"; ?>" rel="stylesheet" type="text/css">
<link href="<?php echo LOCAL . "/public/_styles/search/read.css"; ?>" rel="stylesheet" type="text/css">





<main id="middle_content">

    <nav id="sub_menus_nav">
    </nav>



    <div id="main_content">

    </div>  

    <?php // require_once(PUBLIC_PATH . "/__view/search/create.php"); ?>
    <?php require_once(PUBLIC_PATH . "/__view/search/read.php"); ?>
    <?php // require_once(PUBLIC_PATH . "/__view/search/update.php"); ?>
    <?php // require_once(PUBLIC_PATH . "/__view/search/delete.php"); ?>
    <?php require_once(PUBLIC_PATH . "/_scripts/search/ajax_read.php"); ?>
    <?php // require_once(PUBLIC_PATH . "/_scripts/search/ajax_create.php"); ?>
    <?php // require_once(PUBLIC_PATH . "/_scripts/search/ajax_update.php"); ?>
    <?php // require_once(PUBLIC_PATH . "/_scripts/search/ajax_delete.php"); ?>      

</main>





<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "Search / FatBoy";
</script>





<?php
// TODO: SECTION: This appends the content of the main content to the main placeholder.
?>
<script>
    document.getElementById("middle").appendChild(document.getElementById("middle_content"));
</script>







<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
