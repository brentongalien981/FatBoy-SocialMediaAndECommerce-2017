function do_profile_after_effects(class_name, crud_type, json, x_obj) {
    switch (crud_type) {
        case "read":
            display_profile(crud_type, json);
            break;
        case "create":
            break;
        case "update":
            break;
        case "delete":
            break;
        case "fetch":
            break;
        case "patch":
            break;
    }
}

function display_profile(crud_type, json) {
    //
    var profiles = json.objs;

    //
    for (i = 0; i < profiles.length; i++) {
        var profile = profiles[i];

        // pic-url
        if (profile["pic_url"] == "0") { profile["pic_url"] = get_default_pic_url(); }
        $("#profile-header-pic").attr("src", profile["pic_url"]);


        // profile-description
        if (profile["description"] == null ||
            profile["description"] == "") {
            profile["description"] = "Add your profile description..";
        }
        $("#profile-description").html(profile["description"]);
    }
}