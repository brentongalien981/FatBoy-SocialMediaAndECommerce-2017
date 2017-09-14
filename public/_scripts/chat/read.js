function update_the_cursor_position_value() {
    var current_cursor_position = $('#chat-textarea').prop("selectionStart");

    document.getElementById("input_cursor_position").value = current_cursor_position;
}

function get_the_cursor_position_value() {
    return document.getElementById("input_cursor_position").value;
}