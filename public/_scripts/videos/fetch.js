function set_videos_fetcher() {
    // Get an update every second.
    videos_fetch_handler = setInterval(fetch_videos, 2000);
}

function fetch_videos() {

    if (are_my_videos_fetching) { return; }
    are_my_videos_fetching = true;

    var crud_type = "fetch";
    var request_type = "GET";
    var date_of_latest_obj = get_date_of_latest_el("my-videos", "DESC");


    var key_value_pairs = {
        fetch: "yes",
        shit: "shit",
        date_of_latest_obj: date_of_latest_obj
    };



    var obj = new MyVideo(crud_type, request_type, key_value_pairs);
    obj.fetch();
}