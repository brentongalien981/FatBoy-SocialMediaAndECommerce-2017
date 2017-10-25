function do_timeline_post_reply_after_effects(class_name, crud_type, json, x_obj) {

    switch (crud_type) {
        case "read":
            display_timeline_post_replies(crud_type, json);
            break;
        case "create":
            window.alert("Your comment was SUCCESSFULLY posted.");

            // creates timeline-post-reply-notification records
            var timeline_post_id = json.parent_post_id;
            var timeline_post_reply_id = json.timeline_post_reply_id;


            create_timeline_post_reply_notifications(timeline_post_id, timeline_post_reply_id);
            break;
        case "update":
            break;
        case "delete":
            break;
        case "fetch":
            display_timeline_post_replies(crud_type, json);
            break;
        case "patch":
            break;
    }
}

function display_timeline_post_replies(crud_type, json) {
    // Because I'm just basically re-using this method from the menu timeline-posts,
    // I'm sticking to the var posts instead of timeline_post_replies and
    // p instead of tpr...
    var posts = json.objs;

    //
    for (i = 0; i < posts.length; i++) {

        var p = posts[i];

        /* post_el */
        var post_el = document.createElement("div");
        post_el.id = "comment" + p["post_id"];
        $(post_el).addClass("replies");


        /* post_details_bar */
        var post_details_bar = get_comment_details_bar(p);


        /* post's main content */
        var post_main_content = get_comment_main_content(p);


        /* Append */
        //
        $(post_el).append($(post_details_bar));
        $(post_el).append($(post_main_content));



        /* Append the comment/post_el to the parent-timeline-post. */
        // parent_timeline_post_id
        var the_post_id = json.timeline_post_id;
        var parent_timeline_post_el = $("#post" + the_post_id).get(0);

        // var the_reply_form_el = $(parent_timeline_post_el).find(".replyForm").get(0);

        var the_view_more_comments_button_el = $(parent_timeline_post_el).find(".my-view-more-comments-btn").get(0);

        // $(post_container).append($(post_el));
        $(post_el).insertBefore(the_view_more_comments_button_el);


        // /* Display or hide the view-more-comments-button. */
        // if (get_timeline_post_num_of_comments(the_post_id) >= 3) { $(the_view_more_comments_button_el).css("display", "block"); }
        // else { $(the_view_more_comments_button_el).css("display", "none"); }

    }

}

function get_timeline_post_num_of_comments(timeline_post_id) {
    return $("#post" + timeline_post_id).find(".replies").length;
}