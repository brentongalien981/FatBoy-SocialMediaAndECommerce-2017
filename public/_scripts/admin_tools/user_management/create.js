function set_user_info_inputs(flag) {
    if (flag == RESET_INPUTS) {
        console.log("TODO:REMINDER: In METHOD: Reset User Info input fields are cleared.");

        // Disable the email input.
        email.setAttribute("disabled", "disabled");
        email.style.backgroundColor = "rgb(200, 200, 200)";

        user_id.setAttribute("disabled", "disabled");
        user_id.style.backgroundColor = "rgb(200, 200, 200)";
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