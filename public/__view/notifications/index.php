<?php require_once("../../_layouts/header.php"); ?>




<?php // For app debug messenger initialization. ?>
<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<?php // Make sure the actual user is logged-in.  ?>
<?php
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>






<link href="<?php echo LOCAL . "/public/_styles/notifications/index.css"; ?>" rel="stylesheet" type="text/css">





<main id="middle_content">

    <nav id="sub_menus_nav">
        <!--<a id="add_video_link">Add Video</a>-->
    </nav>



    <div id="main_content">
        <?php // require_once(PUBLIC_PATH . "/__view/notifications/create.php"); ?>
        <?php require_once(PUBLIC_PATH . "/__view/notifications/read.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/__view/notifications/update.php");   ?>
        <?php // require_once(PUBLIC_PATH . "/__view/notifications/delete.php");   ?>       
    </div>   

    <?php
// TODO:SECTION:LOG
    MyDebugMessenger::show_debug_message();
    MyDebugMessenger::clear_debug_message();
    ?>    
</main>





<script>document.getElementById("title").innerHTML = "MyVideos / FatBoy";</script>
<script>document.getElementById("middle").appendChild(document.getElementById("middle_content"));</script>

<?php require_once(PUBLIC_PATH . "/_scripts/notifications/ajax_bridge_controller.php"); ?>
<?php require_once(PUBLIC_PATH . "/_scripts/notifications/ajax_read.php"); ?>
<?php require_once(PUBLIC_PATH . "/_scripts/notifications/ajax_create.php"); ?>
<?php // require_once(PUBLIC_PATH . "/_scripts/notifications/ajax_update.php"); ?>
<?php // require_once(PUBLIC_PATH . "/_scripts/notifications/ajax_delete.php");   ?> 
<?php // require_once(PUBLIC_PATH . "/_scripts/ad_displayer.php"); ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
