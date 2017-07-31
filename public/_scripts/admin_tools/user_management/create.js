function set_user_info_inputs(flag, user_info) {
    clear_user_info_inputs();

    if (flag == EDIT_USER) {
        user_id.setAttribute("disabled", "disabled");
        user_id.style.backgroundColor = "rgb(200, 200, 200)";


        user_id.value = user_info['user_id'];
        user_name.value = user_info['user_name'];
        password.value = "*****";
        email.value = user_info['email'];
        user_type.value = user_info['user_type'];
        privacy.value = user_info['privacy'];
        account_status.value = user_info['account_status'];

        password.setAttribute("disabled", "disabled");
        password.style.backgroundColor = "rgb(200, 200, 200)";

        email.removeAttribute("disabled");
        email.style.backgroundColor = "white";
    }




    if (flag == CREATE_USER) {
        console.log("TODO:REMINDER: In METHOD: Reset User Info input fields are cleared.");

        // Disable the email input.
        email.setAttribute("disabled", "disabled");
        email.style.backgroundColor = "rgb(200, 200, 200)";

        user_id.setAttribute("disabled", "disabled");
        user_id.style.backgroundColor = "rgb(200, 200, 200)";

        password.removeAttribute("disabled");
        password.style.backgroundColor = "white";
    }
}





function create_user(user_info) {
    var crud_type = "create";
    var request_type = "POST";
    var key_value_pairs = {
        create: "yes",
        tae: "shit"
    };

    //
    for (var key in user_info) {
        if(user_info.hasOwnProperty(key)) {
            key_value_pairs[key] = user_info[key];
        }
    }



    var user_obj_request = new User(crud_type, request_type, key_value_pairs);
    user_obj_request.create();
}