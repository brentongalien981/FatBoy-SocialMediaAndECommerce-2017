<div id="users_div" class="section">
    <h4>Users</h4>
    <hr>
    <div id="users_table_container">
        <table id="UsersTable" class="">
            <tbody id="UsersContainer">
            <tr>
                <th>#</th>
                <th>UserId</th>
                <th>UserName</th>
                <th>Email</th>
                <th>UserType</th>
                <th>Privacy</th>
                <th>AccountStatus</th>
                <th>Action</th>
            </tr>
            </tbody>
        </table>
        <div id="reference_for_loading_more"></div>
    </div>
</div>


<div class="section">
    <table>
        <thead>
        <th><h4 id="user_info_title">UserInfo</h4></th>
        <th><input id="add_user_button" type="button" value="+ add user" class="form_button"></th>
        </thead>
    </table>
    <hr class="user_info_hr">

    <!--    User's Basic info form-->
    <?php require_once(PUBLIC_PATH . "/__view/admin_tools/user_management/templates/users_info_forms.php"); ?>


    <input id="edit_user_button" type="button" value="edit" class="form_button">
    <input id="create_user_button" type="button" value="create" class="form_button">
    <input id="cancel_creation_button" type="button" value="cancel" class="form_button">

</div>


<style>
    #UsersTable {
        color: black;
    }

    #UsersTable .form_button {
        margin: 0;
    }

    #users_div {
        /*overflow-y: auto;*/
        height: 150px;
    }

    #users_table_container {
        padding-top: 20px;
        overflow-y: auto;
        height: 80px;
    }

    #reference_for_loading_more {
        width: 200px;
        height: 1px;
        background-color: red;
    }

    input.form_button {
        margin: 0;
        /*display: block;*/
    }

    #user_info_title {
        /*display: inline;*/
        /*width: 50px;*/
        margin-bottom: -6px;
        margin-right: 5px;
        /*background-color: yellow;*/
        color: black;
    }

    hr.user_info_hr {
        margin-bottom: 15px;
    }

    #create_user_button, #cancel_creation_button {
        display: none;
    }
</style>