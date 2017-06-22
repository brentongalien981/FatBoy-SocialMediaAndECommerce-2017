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
    <div class="section">
        <form id='add_video_form' action='<?php echo LOCAL . "/public/__controller/my_videos/create.php"; ?>' method='post'>
            <h4>Add a new video<h4>
            <h6>Video Title</h6>
            <input id="video_title" class='form_input' type='text' name='video_title'>
            <h6>Embedded Code</h6>
            <textarea id="embedded_video_code" class='form_input' name='embedded_video_code' rows='6' cols='100'></textarea><br>
            <input id="create_video_button" type='button' class='form_button' name='add_video' value='add video'>
        </form>
    </div>
<?php } ?>






<?php
// Display all user's videos.
echo "<h4 id='my_videos_h4'>MyVideos</h4>";


//
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