// var firstPhoto = document.getElementById("first-photo");
// firstPhoto.addEventListener("click", function () {
//     this.style.zoom = "200%";
// });

// <script async src="//embedr.flickr.com/assets/client-code.js" charset="utf-8"></script>







/* Functions */
function read_photos() {
    // FLAG
    if (is_ajax_reading) { return; }
    is_ajax_reading = true;

    var crud_type = "read";
    var request_type = "GET";
    var offset = get_num_of_photos_shown();


    var key_value_pairs = {
        // TODO:REMINDER: Change this to a variable.
        read: "yes",
        offset: offset
    };



    var photo_read_request = new Photo(crud_type, request_type, key_value_pairs);
    photo_read_request.read();
}