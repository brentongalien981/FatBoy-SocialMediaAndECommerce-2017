// Set up the necessary infos for this x_notification
var crud_type = "read";
var request_type = "GET";
var key_value_pairs = {
    section:1,
    tae:"shit"
};


// Create a NotificationFriendship object.
// Then call its read method.
var friendship_notification_obj = new NotificationFriendship(crud_type, request_type, key_value_pairs);
friendship_notification_obj.read();
