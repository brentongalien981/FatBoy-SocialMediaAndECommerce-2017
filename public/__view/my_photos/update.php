<?php if ($session->is_viewing_own_account()) { ?>
    <form id='edit_photo_form' class="my-photo-form my-photo-form-section section animated">
        <h3>Editing Photo Details</h3>


        <!--        Title and error msg-->
        <table>
            <tbody>
            <tr>
                <td>
                    <h5 class="">Title</h5>
                </td>

                <td>
                    <label class="error_msg" id="error_edit_photo_title"></label>
                </td>
            </tr>
            </tbody>
        </table>


        <input id="edit_photo_title" class='my-form-input' type='text'>
        <input id="edit_photo_id" class='my-form-input' type='hidden'>






        <!--        Embed code and error msg-->
        <table>
            <tbody>
            <tr>
                <td>
                    <h5 class="">Embed Code</h5>
                </td>

                <td>
                    <label class="error_msg" id="error_edit_embed_code"></label>
                </td>
            </tr>
            </tbody>
        </table>


        <textarea id="edit_embed_code" class='my-form-input' rows='6' cols='100'></textarea>





        <div>
            <input id="edit_photo_button" type='button' class='form_button' value='edit photo'>
            <input id="cancel_photo_edit_button" type='button' class='form_button' value='cancel'>
        </div>
    </form>
<?php } ?>







<link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/my_photos/update.css"; ?>">
