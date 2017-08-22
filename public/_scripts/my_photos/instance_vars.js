const CONTAINER_WIDTH = 990;

// var add_photo_link = document.getElementById("add_photo_link");
var photos_container = document.getElementById("photos_container");
var reference_for_loading_more = document.getElementById("reference_for_loading_more");
var solo_img_container = document.getElementById("solo_img_container");
var is_ajax_reading = false;
var num_of_horizontal_dividers = 0;
var counter_index = 0;
var initial_num_of_photos_shown = 20;
var is_initial_read_done = false;
var stack_index = 0;
var is_click_from_solo_link = false;

var individual_img_mouseover_handler = null;
var individual_img_mouseout_handler = null;
var just_previously_hovered_img_id = "";
var is_mouse_on_photo = false;
var hovered_img = null;
var hovered_caption = null;