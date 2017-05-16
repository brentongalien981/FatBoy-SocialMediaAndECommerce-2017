function createForm(parentPostId) {
    // Disable the reply button when the form shows up.
    document.getElementById("replyButton" + parentPostId).setAttribute("disabled", "disabled");

    var replyForm = document.createElement("form");
    var replyTextAre = document.createElement("textarea");
    var replyButton = document.createElement("input");
    var parentPostHiddenInput = document.createElement("input");    
    var cancelButton = document.createElement("button");
    



    replyForm.setAttribute("action", "timeline_posts_reply.php");
    replyForm.setAttribute("method", "post");
    replyForm.setAttribute("class", "replyForm");

    replyTextAre.setAttribute("name", "reply_text_area");
    replyTextAre.setAttribute("rows", "4");
    replyTextAre.setAttribute("cols", "70");

    parentPostHiddenInput.setAttribute("type", "hidden");
    parentPostHiddenInput.setAttribute("name", "parent_post_id");
    parentPostHiddenInput.setAttribute("value", parentPostId);

    replyButton.setAttribute("type", "submit");
    replyButton.setAttribute("name", "submit");
    replyButton.setAttribute("value", "submit");

    cancelButton.id = "cancelButton";
    cancelButton.innerHTML = "cancel";
    cancelButton.onclick = function () {
        document.getElementById(parentPostId).removeChild(replyForm);
        document.getElementById(parentPostId).removeChild(cancelButton);
        
        // Re-enable the reply button.
        document.getElementById("replyButton" + parentPostId).removeAttribute("disabled");
    };


    replyForm.appendChild(replyTextAre);
    replyForm.appendChild(parentPostHiddenInput);
    replyForm.appendChild(document.createElement("br"));
    replyForm.appendChild(replyButton);
    replyForm.appendChild(cancelButton);

    document.getElementById(parentPostId).appendChild(replyForm);
//    document.getElementById(parentPostId).appendChild(cancelButton);


}