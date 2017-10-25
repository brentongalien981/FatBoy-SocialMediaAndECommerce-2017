function do_timeline_post_subscription_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            break;
        case "create":
            window.alert("Oh yeah! You will now get notifications about this post.");
            break;
        case "update":
            break;
        case "delete":
            break;
        case "fetch":
            break;
        case "patch":
            break;
    }
}



function get_selected_timeline_post_id() {

    // Find the closest timeline-post where the post-settings-popup is in (up the DOM chain).
    var post = $("#tpspw").closest(".message_post");

    // Remove the "post" from "post114".
    var post_id = $(post).attr("id").substring(4);

    return post_id;
}


