<link href="<?php echo LOCAL . "/public/_styles/videos/update.css"; ?>" rel="stylesheet" type="text/css">

<form id="update-video-form">
    <h4>Editing Video</h4>


    <label for="video-title-input-for-update">Video Title</label>
    <input id="video-title-input-for-update" required>


    <label for="video-urlinput-for-update">Video URL</label>
    <textarea id="video-url-input-for-update" required></textarea>

    <input id="update-video-button" type="button" value="update" class="form_button">
    <input id="cancel-update-video-button" type="button" value="cancel" class="form_button">
</form>