<?php require_once(PUBLIC_PATH . "/__controller/controller_my_videos.php"); ?>

<link href="<?php echo LOCAL . "/public/_styles/my_videos/content1.css"; ?>" rel="stylesheet" type="text/css">





<?php
// Make sure the actual user is logged-in.
if (!$session->is_logged_in()) {
    redirect_to("view_log_in.php");
}
?>













<?php
// Show the form for adding a new video.
?>
<?php if ($session->is_viewing_own_account()) { ?>
    <form id='add_video_form' class="section" action='<?php echo LOCAL . "/public/__controller/my_videos/create.php"; ?>' method='post'>
        <h4>Add a new video<h4>
                <h6 class="field_title">Video Title</h6>
                <label class="error_msg" id="error_title"></label>
                <!--<br>-->
                <input id="video_title" class='form_input' type='text'>

                <h6 class="field_title">Embedded Code</h6>
                <label class="error_msg" id="error_embed_code"></label>
                <!--<br>-->
                <textarea id="embed_code" class='form_input' rows='6' cols='100'></textarea>
                <!--<br>-->
                <input id="create_video_button" type='button' class='form_button' value='add video'>
                <input id="cancel_create_video_button" type='button' class='form_button' value='cancel'>
                </form>
            <?php } ?>






            <?php
// Display all user's videos.
            $completely_presented_user_videos_array = get_completely_presented_user_videos_array();

//
            echo "<table id='my_videos_table'>";
//
            foreach ($completely_presented_user_videos_array as $completely_presented_user_video) {
                echo $completely_presented_user_video;
            }
//
            echo "</table>";
            ?>




            <?php
// TODO:SECTION: Pseudo-scripts.
            if ($session->is_viewing_own_account()) {
                require_once(PUBLIC_PATH . "/_scripts/my_videos/ajax_create.php");
            }
            ?>