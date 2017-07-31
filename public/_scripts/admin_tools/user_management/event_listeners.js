
users_table_container.addEventListener("scroll", function () {
    if (!is_ajax_reading) {

        prepare_load_more_users();
    }

});





add_user_button.addEventListener("click", function () {
    // Clear the contents of the form fields.
    set_user_info_inputs(CREATE_USER);

    //
    this.style.visibility = "hidden";

    //
    edit_user_button.style.display = "none";

    //
    create_user_button.style.display = "block";

    //
    cancel_creation_button.style.display = "block";
});






cancel_creation_button.addEventListener("click", function () {
    // Clear the contents of the form fields.
    set_user_info_inputs(DEFAULT);

    // //
    add_user_button.style.visibility = "visible";

    //
    edit_user_button.style.display = "block";

    //
    create_user_button.style.display = "none";

    //
    cancel_creation_button.style.display = "none";
});





create_user_button.addEventListener("click", function () {
    var user_info = {
        user_name : user_name.value,
        password : password.value,
        email : email.value,
        user_type : user_type.value,
        privacy : privacy.value,
        account_status : account_status.value
    };


    // var user_name = user_name.value;
    // var password = password.value;

    create_user(user_info);
});





//edit_user_button
edit_user_button.addEventListener("click", function () {

    var user_info = {
        user_id: user_id.value,
        user_name : user_name.value,
        // password : password.value,
        email : email.value,
        user_type : user_type.value,
        privacy : privacy.value,
        account_status : account_status.value
    };


    // var user_name = user_name.value;
    // var password = password.value;

    edit_user(user_info);
});







/* Functions */
var users_table_container_height = users_table_container.offsetHeight;
var users_table_container_bounds = users_table_container.getBoundingClientRect();

function prepare_load_more_users() {
    // Boundaries of the sides of the reference.
    var reference_for_loading_more_bounds = reference_for_loading_more.getBoundingClientRect();
    var users_table_container_bounds = users_table_container.getBoundingClientRect();


    // reference_for_loading_more's relative position to the users_table_container.
    var reference_for_loading_more_rel_pos = reference_for_loading_more_bounds.top - users_table_container_bounds.top - users_table_container.scrollTop;


    // //
    // console.log("REL POS: " + reference_for_loading_more_rel_pos);


    //
    if (reference_for_loading_more_rel_pos <= 90) {
        // users_container_section += 1;
        is_ajax_reading = true;

        load_more_users();
    }
}





function add_listener_to_edit_user_buttonx(user_id) {
    // Id of the edit-user-button.
    var id = "edit_user_button" + user_id;

    // The actual edit_user_button.
    var edit_user_button = document.getElementById(id);

    edit_user_button.addEventListener("click", function () {
        // window.alert("TODO: Add event listener to this edit_user_button." + user_id);

        // user_info of the selected user row.
        var user_info = get_user_info(user_id);
        //uki

        // TODO:DEBUG
        console.log("***********************************");
        console.log("In METHOD: add_listener_to_edit_user_buttonx()");
        for (var key in user_info) {
            if (user_info.hasOwnProperty(key)) {
                console.log("user_info[" + key + "]:" + user_info[key]);
            }
        }
        console.log("***********************************");



        //
        set_user_info_inputs(EDIT_USER, user_info);

    });

}