// Show all posts reply/comment forms.
// set_comment_forms();


function set_comment_forms() {
    var post = $('.message_post');

    for (i = 0; i < post.length; i++) {
        append_a_comment_form(post[i].id);
    }
}

