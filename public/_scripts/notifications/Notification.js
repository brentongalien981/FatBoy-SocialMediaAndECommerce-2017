function Notification (class_name, crud_type, request_type, key_value_pairs) {
    this.class_name = class_name;
    this.crud_type = crud_type;
    this.request_type = request_type;
    this.key_value_pairs = key_value_pairs;

    // var x_notification_obj = this;

    this.create = function () {
        my_ajax(this)
    }


    this.read = function () {
        my_ajax(this)
    }
}
