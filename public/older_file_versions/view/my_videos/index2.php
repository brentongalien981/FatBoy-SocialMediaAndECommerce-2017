<?php require_once("../../_layouts/header.php"); ?>
<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>




<!--For app debug messenger initialization.-->
<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>












<link href="<?php echo LOCAL . "/public/_styles/my_videos/index.css"; ?>" rel="stylesheet" type="text/css">






<main id="middle_content">



    <!--Sub-menus-->
    <nav id="sub_menus_nav">
        <a id="add_video_link">Add Video</a>
    </nav>


    <div id="main_content">
        <?php
// Decide which main content to display based on the GET param.
        // This menus number of sub-contents.
        $num_of_sub_contents = 1;
        if (isset($_GET["content_page"])) {
            $content_page = $_GET["content_page"];

            if (($content_page > 0) && ($content_page < $num_of_sub_contents)) {
                require_once("sub_menu_content{$content_page}.php");
            } else {
                require_once("sub_menu_content1.php");
            }
        } else {
            // Default sub-content.
            require_once("sub_menu_content1.php");
        }
        ?>








        <?php
// TODO:SECTION:LOG
        MyDebugMessenger::show_debug_message();
        MyDebugMessenger::clear_debug_message();
        ?>
    </div>    
</main>















<script>
    // Edit the page title.
    document.getElementById("title").innerHTML += " / MyVideos";
</script>










<?php
// TODO: SECTION: This appends the content of the main content to the main placeholder.
?>
<script>
    document.getElementById("middle").appendChild(document.getElementById("middle_content"));
</script>







<?php require_once(PUBLIC_PATH . "/_scripts/ad_displayer.php"); ?>











<!--Footer-->
<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>
