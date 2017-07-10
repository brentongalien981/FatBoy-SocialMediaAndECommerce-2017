function Notification(class_name, crud, obj) {
    this.class_name = class_name;
    this.crud = crud;
    this.obj = obj;
    this
    var notification_x_obj = this;
    this.create = function () {
        my_ajax(this);
    }
}
