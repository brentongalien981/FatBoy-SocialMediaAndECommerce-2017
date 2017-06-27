<?php if ($session->is_viewing_own_account()) { ?>
    <form id='add_video_form' class="section" method='post'>
        <h4>Add a new video<h4>
                <h6 class="field_title">Video Title</h6>
                <label class="error_msg" id="error_title"></label>
                <br>
                <input id="video_title" class='form_input' type='text'>

                <h6 class="field_title">Embedded Code</h6>
                <label class="error_msg" id="error_embed_code"></label>
                <br>
                <textarea id="embed_code" class='form_input' rows='6' cols='100'></textarea>
                <input id="create_video_button" type='button' class='form_button' value='add video'>
                <input id="cancel_create_video_button" type='button' class='form_button' value='cancel'>
                </form>
            <?php } ?>