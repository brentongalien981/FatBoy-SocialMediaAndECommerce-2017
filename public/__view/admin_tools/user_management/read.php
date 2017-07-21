<div id="users_div" class="section">
    <h4>Users</h4>
    <hr>
    <div id="users_table_container">
        <table id="UsersTable" class="">
            <tbody id="UsersContainer">
            <tr>
                <th>UserId</th>
                <th>UserName</th>
                <th>Email</th>
                <th>UserType</th>
            </tr>
            </tbody>
        </table>
        <div id="reference_for_loading_more"></div>
    </div>
</div>


<div class="section">
    <h4>UserInfo</h4>
    <hr>
</div>






<style>
    #UsersTable {
        color: black;
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
</style>