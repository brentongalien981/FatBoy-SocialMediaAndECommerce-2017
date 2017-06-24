<?php require_once(PUBLIC_PATH . "/__controller/profile/work/read.php"); ?>





<?php
// TODO: SECTION: Protected page.
if (!$session->is_logged_in()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>






<div id="work" class='section'>
    <table>
        <tbody>
            <tr>
                <td>
                    <h4 id='h4_work_experience'>Work Experience</h4>
                </td>

                <td>
                    <?php
                    // Display button for adding a work experience.
                    global $session;
                    if ($session->is_viewing_own_account()) {
                        echo "<button id='button_add_work_experience' class='form_button'>+ add an experience</button>";
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>


    <?php display_form_work_experience(); ?>
    <div id="work_experiences_container"></div>
    <?php // display_work_experience();  ?>

</div>

<?php
if ($session->is_viewing_own_account()) {
    require_once(PUBLIC_PATH . "/__view/profile/work/a_work_experience_div_template.php");
}
?>





<?php require_once(PUBLIC_PATH . "/__view/profile/work/create.php"); ?>
<?php // require_once(PUBLIC_PATH . "/__view/profile/work/update.php");    ?>
<?php // require_once(PUBLIC_PATH . "/__view/profile/work/delete.php");    ?>





<?php
// TODO:SECTION: Pseudo-scripts.
if ($session->is_viewing_own_account()) {
    require_once(PUBLIC_PATH . "/_scripts/profile/work/ajax_read.php");
}
?>