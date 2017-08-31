clear_login_form_inputs();

function clear_login_form_inputs() {
    // window.alert("pota boy");
    // $('#user_name').val('');
    // $('#password').val('');

    var user_name = document.getElementById("user_name");
    var password = document.getElementById("password");

    user_name.setAttribute("value", "");
    password.setAttribute("value", "");
}