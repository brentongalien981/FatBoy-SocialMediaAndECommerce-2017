<div id="search_users_section" class="section user_management_sections">

    <h4>Search Users</h4>
    <hr>


    <table>
        <tbody>
            <tr>
                <td>Filter Search</td>
                <td><input id="filter_search_checkbox" type="checkbox" value="filter_search">yes / no</td>
            </tr>
        </tbody>
    </table>
    
    <hr id="filter_search_hr">



<!--    For filtered search-->
    <form id="filtered_search_form" class="">
        <table>
            <tbody>

            <tr>
                <td class=""><h6>UserId</h6></td>
                <td class=""><input id="filtered_search_user_id_input" type="text"></td>
            </tr>


            <tr>
                <td class=""><h6>UserName</h6></td>
                <td class=""><input id="filtered_search_user_name_input" type="text"></td>
            </tr>







            <tr>
                <td class=""><h6>Email</h6></td>
                <td class=""><input id="filtered_search_email_input" type=""></td>
            </tr>





            <tr>
                <td class=""><h6>UserType</h6></td>
                <td class="">
                    <select id="filtered_search_user_type_input">
                        <option value="">Any</option>
                        <option value="1">User</option>
                        <option value="2">Admin</option>
                        <option value="3">Owner</option>
                        <option value="4">Accountant</option>
                        <option value="5">Legal</option>
                    </select>
                </td>
            </tr>





            <tr>
                <td class=""><h6>Privacy</h6></td>
                <td class="">
                    <select id="filtered_search_privacy_input">
                        <option value="">Any</option>
                        <option value="1">Private</option>
                        <option value="0">Public</option>
                    </select>
                </td>
            </tr>





            <tr>
                <td class=""><h6>AccountStatus</h6></td>
                <td class="">
                    <select id="filtered_search_account_status_input">
                        <option value="">Any</option>
                        <option value="1">Active</option>
                        <option value="2">Blocked</option>
                        <option value="3">Under Investigation</option>
                        <option value="4">Tracked</option>
                    </select>
                </td>
            </tr>



            <tr>
                <td class=""></td>
                <td class="">
                    <input id="filter_search_button" type="button" value="search" class="form_button">
                </td>
            </tr>


            </tbody>
        </table>
    </form>




    <!--    For simple search-->
    <form id="simple_search_form">
        <table>

            <tbody>
            <tr>
                <td><input id="simple_search_text_input" type="text"></td>
                <td><input id="simple_search_button" type="button" value="search" class="form_button"></td>
            </tr>
            </tbody>
        </table>
    </form>

</div>





<style>
    #search_users_section * {
        color: black;
    }

    #filter_search_hr {
        margin-bottom: 40px;
    }

    /*#user_management_search_form {*/
    .user_management_sections form {
        /*color: black;*/
        /*width: 480px;*/
        /*height: 270px;*/
        background-color: #2aa198;
        /*float: left;*/
    }
    
    #filtered_search_form {
        display: none;
    }
</style>