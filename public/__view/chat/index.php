<?php require_once("../../_layouts/header.php"); ?>


<!--For app debug messenger initialization.-->
<?php
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/__view/view_log_in.php");
}
?>





<!--uki-->
<link href="<?php echo LOCAL . "/public/_styles/chat/index.css"; ?>" rel="stylesheet" type="text/css">





<main id="middle_content">

    <nav id="sub_menus_nav">
        <a href="#" id="sub_nav_chat_with">Chat with</a>
        <a href="#" id="sub_nav_chat_window">Chat Window</a>
    </nav>



    <div id="main_content">
        <?php require_once(PUBLIC_PATH . "/__view/chat/create.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/__view/chat/read.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/__view/chat/update.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/__view/chat/delete.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/_scripts/chat/ajax_read.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/_scripts/chat/ajax_create.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/_scripts/chat/ajax_update.php"); ?>
        <?php // require_once(PUBLIC_PATH . "/_scripts/chat/ajax_delete.php"); ?>        





        <?php
// TODO:SECTION:LOG
        MyDebugMessenger::show_debug_message();
        MyDebugMessenger::clear_debug_message();
        ?>
    </div>    
</main>





<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "Chat / FatBoy";
</script>





<?php
// TODO: SECTION: This appends the content of the main content to the main placeholder.
?>
<script>
    document.getElementById("middle").appendChild(document.getElementById("middle_content"));
</script>






<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>