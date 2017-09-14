function set_chat_textarea(key_value) {

    var old_content = $("#chat-textarea").val();
    var cursor_position = get_the_cursor_position_value();
    var new_content = old_content.substring(0, cursor_position) + key_value + old_content.substring(cursor_position);

    $("#chat-textarea").remove();

    var the_new_textarea = document.createElement("textarea");
    the_new_textarea.id = "chat-textarea";
    $(the_new_textarea).html("" + new_content);

    // $(the_new_textarea).append($("#keyboard-container"));
    $("#chat-textarea-container").append($(the_new_textarea));


    //
    set_textarea_listener();

    // +2 because html convert html entities to unicode that has length 2.
    var new_cursor_position = parseInt(cursor_position) + 2;
    setCaretToPos(the_new_textarea, new_cursor_position);
    the_new_textarea.focus();

    //
    // $("#keyboard-container").css("background-color", "white");
}

function setCaretToPos(input, pos) {
    setSelectionRange(input, pos, pos);
}

function setSelectionRange(input, selectionStart, selectionEnd) {
    if (input.setSelectionRange) {
        input.focus();
        input.setSelectionRange(selectionStart, selectionEnd);
    } else if (input.createTextRange) {
        var range = input.createTextRange();
        range.collapse(true);
        range.moveEnd('character', selectionEnd);
        range.moveStart('character', selectionStart);
        range.select();
    }
}

function set_textarea_listener() {
    $("#chat-textarea").on("mousedown mouseup keydown keyup", update_the_cursor_position_value);
}

function update_the_cursor_position_value() {
    var current_cursor_position = $("#chat-textarea").prop("selectionStart");

    document.getElementById("input_cursor_position").value = current_cursor_position;
}