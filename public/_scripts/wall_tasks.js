// Show all posts reply/comment forms.
set_comment_forms();
set_main_content();

function set_main_content() {
    $('#main_content').css("background-color", "rgb(240, 240, 240)");
}

function set_comment_forms() {
    var post = $('.message_post');

    for (i = 0; i < post.length; i++) {
        append_a_comment_form(post[i].id);
    }
}

function append_a_comment_form(parentPostId) {
    the_parent_post_id = parentPostId;

    // // Disable the reply button when the form shows up.
    // document.getElementById("replyButton" + parentPostId).setAttribute("disabled", "disabled");


    var replyForm = document.createElement("form");
    var replyTextAre = document.createElement("textarea");
    var replyButton = document.createElement("input");
    // var cancelButton = document.createElement("input");


    replyForm.id = "replyForm" + parentPostId;
    replyForm.setAttribute("class", "replyForm");

    replyTextAre.setAttribute("placeholder", "Comment here...");
    replyTextAre.setAttribute("rows", "4");
    replyTextAre.setAttribute("cols", "70");


    replyButton.setAttribute("type", "button");
    replyButton.setAttribute("value", "submit");
    replyButton.setAttribute("class", "form_buttons");

    replyButton.onclick = function () {
        create_reply_post(parentPostId);
    };



    replyForm.appendChild(replyTextAre);
    replyForm.appendChild(document.createElement("br"));
    replyForm.appendChild(replyButton);
    // replyForm.appendChild(cancelButton);

    // document.getElementById(parentPostId).insertBefore(replyForm, document.getElementById(parentPostId).childNodes[3]);
    var post = document.getElementById(parentPostId);
    post.appendChild(replyForm);
}