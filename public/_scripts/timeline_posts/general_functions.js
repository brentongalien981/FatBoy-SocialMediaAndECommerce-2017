function get_timeline_post_latest_date() {

    // Just traverse the DOM for the date of the lates post.
    var latest_date_el = $(".message_post").find(".meta-date")[0];
    var latest_date = null;

    if (latest_date_el != null) {
        latest_date = $(".message_post").find(".meta-date")[0].innerHTML;
    }
    else {
        latest_date = "2010-09-11 10:54:45";
    }

    return latest_date;
}

function do_timeline_post_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            display_timeline_post(crud_type, json);
            break;
        case "create":
            // Clear the textarea.
            document.getElementById("message_post_textarea").value = "";

            //
            hide_create_post_form();
            break;
        case "update":
            break;
        case "delete":
            break;
        case "fetch":
            display_timeline_post(crud_type, json);
            break;
    }
}

function display_timeline_post(crud_type, json) {
    //
    var posts = json.objs;

    //
    for (i = 0; i < posts.length; i++) {
        var p = posts[i];

        /* post container */
        var post_container = document.createElement("div");
        post_container.setAttribute("class", "post_background");


        /* post_el */
        var post_el = document.createElement("div");
        post_el.id = "post" + p["post_id"];
        $(post_el).addClass("message_post");


        /* post_details_bar */
        var post_details_bar = get_post_details_bar(p);


        /* post's main content */
        var post_main_content = get_post_main_content(p);


        /* post's response bar */
        var post_response_bar = get_post_response_bar(p);


        /* This div is just to have a reference for appending the reply form. */
        var reference_div = document.createElement("div");
        $(reference_div).addClass("empty_div_shit");


        /* Append */
        //
        $(post_el).append($(post_details_bar));
        $(post_el).append($(post_main_content));
        $(post_el).append($(post_response_bar));
        $(post_el).append($(reference_div));

        //
        $(post_container).append($(post_el));


        /* */
        dom_append_post(crud_type, post_container);


        /* Append a view-more-comments-button. */
        append_view_more_comments_button(p["post_id"]);


        /* Add the post's reply-form */
        append_a_comment_form(p["post_id"]);



        /* Read the post's comments. */
        read_timeline_post_replies(p["post_id"]);



        /* Set the response bar. */
        if (crud_type == "fetch") {

            //
            create_rateable_item(p["post_id"]);

        }
        else if (crud_type == "read") {

            // This will always just read one rateable_item with one post_id.
            var post_ids = [p["post_id"]];
            read_rateable_item_ids(post_ids);
        }
    }


}

function set_main_content() {
    $('#main_content').css("background-color", "rgb(240, 240, 240)");
}