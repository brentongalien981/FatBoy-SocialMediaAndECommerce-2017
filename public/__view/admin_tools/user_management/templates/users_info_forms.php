<table id="user_info_main_table">
    <tbody>
        <tr>
            <td>
                <form class="user_info_forms">
                    <h5>Basic Info</h5>
                    <table>
                        <tbody>
                        <tr>
                            <td colspan="2">
                                <label class='error_msg' visibility='hidden' id=''></label>
                            </td>
                        </tr>

                        <tr>
                            <td class="create_user_info"><h6>UserId</h6></td>
                            <td class="create_user_info"><input id="user_id" type="text" disabled></td>
                        </tr>





                        <tr>
                            <td colspan="2">
                                <label class='error_msg' visibility='hidden' id='error_user_name'>error</label>
                            </td>
                        </tr>

                        <tr>
                            <td class="create_user_info"><h6>UserName</h6></td>
                            <td class="create_user_info"><input id="user_name" type="text"></td>
                        </tr>





                        <tr>
                            <td colspan="2">
                                <label class='error_msg' visibility='hidden' id='error_password'>error</label>
                            </td>
                        </tr>

                        <tr>
                            <td class="create_user_info"><h6>Password</h6></td>
                            <td class="create_user_info"><input id="password" type="password"></td>
                        </tr>






                        <tr>
                            <td colspan="2">
                                <label class='error_msg' visibility='hidden' id='error_email'>error</label>
                            </td>
                        </tr>

                        <tr>
                            <td class="create_user_info"><h6>Email</h6></td>
                            <td class="create_user_info"><input id="email" type="email"></td>
                        </tr>






                        <tr>
                            <td colspan="2">
                                <label class='error_msg' visibility='hidden' id='error_user_type'>error</label>
                            </td>
                        </tr>

                        <tr>
                            <td class="create_user_info"><h6>UserType</h6></td>
                            <td class="create_user_info">
                                <select id="user_type">
                                    <option value="1">User</option>
                                    <option value="2">Admin</option>
                                    <option value="3">Owner</option>
                                    <option value="4">Accountant</option>
                                    <option value="5">Legal</option>
                                </select>
                            </td>
                        </tr>






                        <tr>
                            <td colspan="2">
                                <label class='error_msg' visibility='hidden' id='error_privacy'>error</label>
                            </td>
                        </tr>

                        <tr>
                            <td class="create_user_info"><h6>Private</h6></td>
                            <td class="create_user_info">
                                <select id="privacy">
                                    <option value="1">Private</option>
                                    <option value="0">Public</option>
                                </select>
                            </td>
                        </tr>







                        <tr>
                            <td colspan="2">
                                <label class='error_msg' visibility='hidden' id='error_account_status'>error</label>
                            </td>
                        </tr>

                        <tr>
                            <td class="create_user_info"><h6>AccountStatus</h6></td>
                            <td class="create_user_info">
                                <select id="account_status">
                                    <option value="1">Active</option>
                                    <option value="2">Blocked</option>
                                    <option value="3">Under Investigation</option>
                                    <option value="4">Tracked</option>
                                </select>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </td>







<!--            Address-->
<!--            <td>-->
<!--                <form class="user_info_forms">-->
<!--                    <h5>Contact</h5>-->
<!--                    <table>-->
<!--                        <tbody>-->
<!--                        <tr>-->
<!--                            <td><h6>Street1</h6></td>-->
<!--                            <td><input type="text"></td>-->
<!--                        </tr>-->
<!---->
<!--                        <tr>-->
<!--                            <td><h6>Street2</h6></td>-->
<!--                            <td><input type="text"></td>-->
<!--                        </tr>-->
<!---->
<!--                        <tr>-->
<!--                            <td><h6>City</h6></td>-->
<!--                            <td><input type="text"></td>-->
<!--                        </tr>-->
<!---->
<!--                        <tr>-->
<!--                            <td><h6>State</h6></td>-->
<!--                            <td><input type="text"></td>-->
<!--                        </tr>-->
<!---->
<!--                        <tr>-->
<!--                            <td><h6>ZIP</h6></td>-->
<!--                            <td><input type="text"></td>-->
<!--                        </tr>-->
<!---->
<!--                        <tr>-->
<!--                            <td><h6>Country</h6></td>-->
<!--                            <td><input type="text"></td>-->
<!--                        </tr>-->
<!---->
<!--                        <tr>-->
<!--                            <td><h6>Phone</h6></td>-->
<!--                            <td><input type="text"></td>-->
<!--                        </tr>-->
<!--                        </tbody>-->
<!--                    </table>-->
<!--                </form>-->
<!--            </td>-->
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

    #user_id {
        background-color: rgb(200, 200, 200);
    }

    form.user_info_forms {
        color: black;
        width: 480px;
        /*height: 270px;*/
        background-color: #2aa198;
        /*float: left;*/
    }

    form.user_info_forms h6 {
        color: black;
    }

    td.create_user_info {
        padding-bottom: 10px;
    }

</style>