<?php // TODO:REMINDER: Remove this later.    ?>
<?php require_once(PUBLIC_PATH . "/__controller/controller_my_videos.php"); ?>

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