<table id="user_info_main_table">
    <tbody>
        <tr>
            <td>
                <form class="user_info_forms">
                    <h5>Basic Info</h5>
                    <table>
                        <tbody>
                        <tr>
                            <td><h6>UserId</h6></td>
                            <td><input id="user_id" type="text"></td>
                        </tr>

                        <tr>
                            <td><h6>UserName</h6></td>
                            <td><input id="user_name" type="text"></td>
                        </tr>


                        <tr>
                            <td><h6>Password</h6></td>
                            <td><input id="password" type="password"></td>
                        </tr>

                        <tr>
                            <td><h6>Email</h6></td>
                            <td><input id="email" type="email"></td>
                        </tr>

                        <tr>
                            <td><h6>UserType</h6></td>
                            <td>
                                <select id="user_type">
                                    <option>User</option>
                                    <option>Admin</option>
                                    <option>Owner</option>
                                    <option>Accountant</option>
                                    <option>Legal</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><h6>Private</h6></td>
                            <td>
                                <select id="private">
                                    <option>Private</option>
                                    <option>Public</option>
                                </select>
                            </td>
                        </tr>


                        <tr>
                            <td><h6>AccountStatus</h6></td>
                            <td>
                                <select id="account_status">
                                    <option>Active</option>
                                    <option>Blocked</option>
                                    <option>Under Investigation</option>
                                    <option>Tracked</option>
                                </select>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </td>


            <td>
                <form class="user_info_forms">
                    <h5>Contact</h5>
                    <table>
                        <tbody>
                        <tr>
                            <td><h6>Street1</h6></td>
                            <td><input type="text"></td>
                        </tr>

                        <tr>
                            <td><h6>Street2</h6></td>
                            <td><input type="text"></td>
                        </tr>

                        <tr>
                            <td><h6>City</h6></td>
                            <td><input type="text"></td>
                        </tr>

                        <tr>
                            <td><h6>State</h6></td>
                            <td><input type="text"></td>
                        </tr>

                        <tr>
                            <td><h6>ZIP</h6></td>
                            <td><input type="text"></td>
                        </tr>

                        <tr>
                            <td><h6>Country</h6></td>
                            <td><input type="text"></td>
                        </tr>

                        <tr>
                            <td><h6>Phone</h6></td>
                            <td><input type="text"></td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </td>
        </tr>
    </tbody>
</table>







<style>
    #user_info_main_table {
        margin: 0;
        padding: 0;

    }

    #user_info_main_table table {
        margin: 0;
        padding: 0;
    }

    form.user_info_forms {
        color: black;
        width: 480px;
        height: 270px;
        background-color: #2aa198;
        /*float: left;*/
    }

    form.user_info_forms h6 {
        color: black;
    }
</style>