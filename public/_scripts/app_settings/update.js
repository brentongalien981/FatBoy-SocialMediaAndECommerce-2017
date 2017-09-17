function update_app_settings() {

    //
    var crud_type = "update";
    var request_type = "POST";

    var notifications_is_maximized = $("#notifications-widget-main-container").css("display");
    notifications_is_maximized = (notifications_is_maximized == "block") ? true : false;

    var key_value_pairs = {
        update: "yes",
        notifications_is_maximized: notifications_is_maximized
    };

    var obj = new AppSetting(crud_type, request_type, key_value_pairs);
    obj.update();
}