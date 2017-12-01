<?php if (!$session->is_viewing_own_account()) { return; } ?>
<link rel="stylesheet" type="text/css" href="<?= LOCAL . "/public/_styles/videos/create.css"; ?>">
<form id='add_video_form' class="my-video-form my-video-form-section add-video-form-section section animated">
    <h3>New video Details</h3>


    <!--        Title and error msg-->
    <table>
        <tbody>
        <tr>
            <td>
                <h5 class="">Title</h5>
            </td>

            <td>
                <label class="error_msg" id="error_video_title"></label>
            </td>
        </tr>
        </tbody>
    </table>


    <input id="video_title" class='my-form-input'>


    <!--        Embed code and error msg-->
    <table>
        <tbody>
        <tr>
            <td>
                <h5 class="">Embed Code</h5>
            </td>

            <td>
                <label class="error_msg" id="error_embed_code"></label>
            </td>
        </tr>
        </tbody>
    </table>


    <textarea id="embed_code" class='my-form-input' rows='6' cols='100'></textarea>


    <div>
        <input id="create_video_button" type='button' class='form_button' value='add video'>
        <input id="cancel_video_creation_button" type='button' class='form_button' value='cancel'>
    </div>
</form>
