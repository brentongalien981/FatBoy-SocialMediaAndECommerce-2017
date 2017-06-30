<?php require_once("../../_layouts/header.php"); ?>


<?php
// TODO:NOTE: This chunk of code should only be present
//            on FILES: index.phps of every MENU such as this, "Profile".
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in()) {
    redirect_to("view_log_in.php");
}
?>




<link href="<?php echo LOCAL . "/public/_styles/profile/main.css"; ?>" rel="stylesheet" type="text/css">

<?php // TODO:REMINDER: Put this to a separate file like ?>
<?php // T              __view/profile/sub_menus.php. ?>
<main id="middle_content">

    <nav id="sub_menus_nav">
        <!--<a href="" id="sub_nav_chat_with">Sub-menu A</a>-->
    </nav>



    <div id="main_content">
        <div class="section" style="font-size: 13px;font-weight: 100;">
            Oops, this profile is private..<br>
            Maybe add this user as your friend, you know...
        </div>

        <?php
// TODO: SECTION: LOG
        MyDebugMessenger::show_debug_message();
        MyDebugMessenger::clear_debug_message();
        ?>
    </div>
</main>





<script>
    // Edit the page title.
    document.getElementById("title").innerHTML = "Profile / FatBoy";
</script>






<?php
// TODO: SECTION: This appends the content of the main content to the main placeholder.
?>
<script>
    document.getElementById("middle").appendChild(document.getElementById("middle_content"));
</script>






<?php include(PUBLIC_PATH . "/_layouts/footer.php"); ?>