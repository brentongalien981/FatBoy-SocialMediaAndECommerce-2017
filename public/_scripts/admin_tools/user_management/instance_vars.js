var users_table_container = document.getElementById("users_table_container");
var reference_for_loading_more = document.getElementById("reference_for_loading_more");
var users_table_container = document.getElementById("users_table_container");
var UsersContainer = document.getElementById("UsersContainer");
var users_container_section = 1;
var last_value_of_section = 0;
var is_ajax_reading = false;
var users_per_section = 5;
var user_counter = 1;
var add_user_button = document.getElementById("add_user_button");
var create_user_button = document.getElementById("create_user_button");
const RESET_INPUTS = 1;

var user_id = document.getElementById("user_id");
var user_name = document.getElementById("user_name");
var password = document.getElementById("password");
var email = document.getElementById("email");
var user_type = document.getElementById("user_type");
var privacy = document.getElementById("privacy");
var account_status = document.getElementById("account_status");