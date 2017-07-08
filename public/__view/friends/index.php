<?php require_once("../../_layouts/header.php"); ?>





<?php // TODO:SECTION: For app debug messenger initialization. ?>
<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<?php // TODO:REMINDER: Implement MyAppRouter:: ?>
<?php // TODO:SECTION: Make sure the actual user is logged-in.  ?>
<?php
if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>





<?php // TODO:SECTION: Styles.   ?>
<link href="<?php echo LOCAL . "/public/_styles/friends/index.css"; ?>" rel="stylesheet" type="text/css">






<?php // TODO:SECTION: Main.   ?>
<main id="middle_content">

    <nav id="sub_menus_nav">
        <!--<a id="add_video_link">Add Video</a>-->
    </nav>



    <div id="main_content">
        <?php  require_once(PUBLIC_PATH . "/__view/friends/muses/index.php"); ?>
        <?php  require_once(PUBLIC_PATH . "/__view/friends/followers/index.php"); ?>
        <?php require_once(PUBLIC_PATH . "/__view/friends/suggestions/index.php"); ?>

    </div>    

<?php // TODO:SECTION: Log.   ?>
<?php MyDebugMessenger::show_debug_message(); ?>
<?php MyDebugMessenger::clear_debug_message(); ?>    
</main>






<?php // TODO:SECTION: Scripts.  ?>
<script>document.getElementById("title").innerHTML = "Friends / FatBoy";</script>
<script>document.getElementById("middle").appendChild(document.getElementById("middle_content"));</script>






<?php // TODO:SECTION:Script: Ad Displayer.  ?>
<?php // require_once(PUBLIC_PATH . "/_scripts/ad_displayer.php"); ?>


<?php // TODO:SECTION: Footer.  ?>
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>