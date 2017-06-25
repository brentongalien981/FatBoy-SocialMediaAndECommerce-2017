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


    <?php require_once(PUBLIC_PATH . "/__view/profile/work/work_experience_form.php"); ?>

    <?php // TODO:SECTION: Placeholder ?>
    <div id="work_experiences_container"></div>

</div>





<?php require_once(PUBLIC_PATH . "/__view/profile/work/a_work_experience_div_template.php"); ?>