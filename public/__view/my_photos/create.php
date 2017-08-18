<?php if ($session->is_viewing_own_account()) { ?>
    <form id='add_photo_form' class="section add-photo-form-section" method=''>
        <h3>New Photo Details</h3>


<!--        Title and error msg-->
        <table>
            <tbody>
                <tr>
                    <td>
                        <h5 class="">Title</h5>
                    </td>

                    <td>
                        <label class="error_msg" id="error_photo_title"></label>
                    </td>
                </tr>
            </tbody>
        </table>


        <input id="photo_title" class='my-form-input' type='text'>






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
            <input id="create_photo_button" type='button' class='form_button' value='add photo'>
            <input id="cancel_photo_creation_button" type='button' class='form_button' value='cancel'>
        </div>
    </form>
<?php } ?>





<link rel="stylesheet" type="text/css" href="<?php echo LOCAL . "/public/_styles/my_photos/create.css"; ?>">
