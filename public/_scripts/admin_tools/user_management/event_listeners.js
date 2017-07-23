
users_table_container.addEventListener("scroll", function () {
    if (!is_ajax_reading) {

        prepare_load_more_agent();
    }

});





add_user_button.addEventListener("click", function () {
    set_user_info_inputs(RESET_INPUTS);

    //
    this.style.visibility = "hidden";
});





create_user_button.addEventListener("click", function () {
    var user_info = {
        user_name: user_name.value,
        password: password.value,
        email: email.value
    };


    // var user_name = user_name.value;
    // var password = password.value;

    create_user(user_info);
});





var users_table_container_height = users_table_container.offsetHeight;
var users_table_container_bounds = users_table_container.getBoundingClientRect();

function prepare_load_more_agent() {
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