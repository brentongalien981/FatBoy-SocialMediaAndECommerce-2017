var categorized_notification_container_template = document.getElementById("categorized_notification_container_template");
var main_content = document.getElementById("main_content");
var b_widget = document.getElementById("b-widget");
var notifications_widget_main_container = document.getElementById("notifications-widget-main-container");
var global_notification_counter = 0;
var global_notification_timer_handler = null;
var num_notifications_per_section = 2; // TODO:REMINDER: Change this to 10 later.