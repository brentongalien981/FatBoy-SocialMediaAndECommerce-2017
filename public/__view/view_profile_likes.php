<?php require_once(PUBLIC_PATH . "/__controller/controller_like.php"); ?>

<link href="<?php echo LOCAL . "/public/_styles/profile/likes.css"; ?>" rel="stylesheet" type="text/css">

<div class="section">


    <!--Contact Info Header table.-->
    <table>
        <tbody>
            <tr>
                <td><h4>Likes</h4></td>

                <td><?php show_add_a_like_button(); ?></td>
            </tr>
        </tbody>
    </table>

    <hr>    


    <?php // Form for letting the actual user add her likes.?>

    <form id='add_like_form' action='<?php echo LOCAL . "/public/__controller/controller_like.php"; ?>' method='post'>
        <h4>A new like</h4>
        <input id="the_like_input" class='form_text_input' name='a_new_like' value='' type='text'><br>
        <label class="error_msg" id="error_the_like_value"></label><br>
        <input id='add_the_like_button' class='form_button' type='button' value='add like'>
        <input id='cancel_add_the_like_button' class='form_button' type='button' value='cancel'>
    </form>    



    <table id='like_table'>
    </table>
</div>