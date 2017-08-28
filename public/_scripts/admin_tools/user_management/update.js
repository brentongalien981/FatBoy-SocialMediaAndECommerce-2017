function update_user() {
    window.alert("TODO: METHOD: update_user()");
    return;

    var crud_type = "update";
    var request_type = "POST";
    var key_value_pairs = {
        update: "yes",
        tae: "shit"
    };

    //
    for (var key in user_info) {
        if (user_info.hasOwnProperty(key)) {
            key_value_pairs[key] = user_info[key];
        }
    }


    var user_obj_request = new User(crud_type, request_type, key_value_pairs);
    user_obj_request.update();
}


function get_user_info(user_id) {
    // The row the the user.
    var user_tr = document.getElementById("user_tr" + user_id);

    //
    var user_name = user_tr.childNodes[2].innerHTML;
    var email = user_tr.childNodes[3].innerHTML;
    var user_type = user_tr.childNodes[4].innerHTML;
    var privacy = user_tr.childNodes[5].innerHTML;
    var account_status = user_tr.childNodes[6].innerHTML;

    //
    var user_info = {
        user_id: user_id,
        user_name: user_name,
        email: email,
        user_type: user_type,
        privacy: privacy,
        account_status: account_status
    };

    //
    return user_info;
}





function edit_user(user_info) {
    var crud_type = "update";
    var request_type = "POST";
    var key_value_pairs = {
        update: "yes",
        tae: "shit"
    };

    //
    for (var key in user_info) {
        if(user_info.hasOwnProperty(key)) {
            key_value_pairs[key] = user_info[key];
        }
    }



    var user_obj_request = new User(crud_type, request_type, key_value_pairs);
    user_obj_request.update();
}





function update_user_info_display(user_id) {
    // window.alert("DEBUG:VAR:user_id: " + user_id);return;
    
    // The row the the user.
    var user_tr = document.getElementById("user_tr" + user_id);

    //
    var td_user_name = user_tr.childNodes[2];
    var td_email = user_tr.childNodes[3];
    var td_user_type = user_tr.childNodes[4];
    var td_privacy = user_tr.childNodes[5];
    var td_account_status = user_tr.childNodes[6];


    //
    td_user_name.innerHTML = user_name.value;
    td_email.innerHTML = email.value;
    td_user_type.innerHTML = user_type.value;
    td_privacy.innerHTML = privacy.value;
    td_account_status.innerHTML = account_status.value;

}