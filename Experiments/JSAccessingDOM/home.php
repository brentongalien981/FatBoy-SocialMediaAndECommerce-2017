<div id="a_work_experience_div_template" class='a_work_experience'>
    <div class='work_exp_action_div user_work_exp_action_div'>
        <input id='work_experience_delete_button' type='button' class='form_button form_button_actions form_button_delete' value='delete'>
        <input id='work_experience_edit_button' type='button' class='form_button form_button_actions form_button_edit' value='edit'>
    </div>


    <table>
        <tbody>
            <tr>
                <td>
                    <h5 id="title_company_name"></h5>
                </td>

                <td class='td_right_aligned'>
                    <h5 id="title_place"></h5>
                </td>
            </tr>

            <tr>
                <td>
                    <h5 id="title_position"></h5>
                </td>

                <td class='td_right_aligned'>
                    <h5 id="title_time_frame"></h5>
                </td>
            </tr>

            <tr>
                <td colspan='2'>
                    <ul>
                        <!--display_work_experience_task($row['id']);-->
                    </ul>
                </td>
            </tr>            
        </tbody>
    </table>
</div>

<script>
    var new_work_experience_div_template = document.getElementById("a_work_experience_div_template");
//    new_work_experience_div_template.childNodes[1].childNodes[0].childNodes[0].childNodes[0].childNodes[0].id = "title_company_name";
    console.log("new_work_experience_div_template.childNodes[3].childNodes[1].childNodes[3].childNodes[0].innerHTML: " + new_work_experience_div_template.childNodes[3].childNodes[1].childNodes[1].childNodes[3].childNodes[1].id);
</script>