async function initialize_fetch_timeline_posts() {
    while (!can_timeline_posts_fetch) {
        await my_sleep(5000);
    }

    set_timeline_posts_fetcher();
}

function set_timeline_posts_fetcher() {
    // Get an update every x second.
    timeline_posts_fetch_handler = setInterval(fetch_timeline_posts, 3000);
}


function fetch_timeline_posts() {
    var latest_timeline_post_date = get_timeline_post_latest_date();

    var crud_type = "fetch";
    var request_type = "GET";
    var key_value_pairs = {
        fetch : "yes",
        latest_timeline_post_date: latest_timeline_post_date
    };


    var obj = new TimelinePost(crud_type, request_type, key_value_pairs);
    obj.fetch();
}