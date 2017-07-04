<?php

if (isset($_GET["get_all_friend_suggestions"]) && ($_GET["get_all_friend_suggestions"] == "yes")) {
    return_all_suggested_friends();
}
?>






<?php

/**
 * 
 * @global type $session
 * @global type $database
 */
function return_all_suggested_friends() {
    //
    global $session;
    $query = Friendship::get_query_for_suggested_friends($session->actual_user_id);

    // @$all_suggested_friends is an array
    // that contains all the info of each suggested friends.
    $all_suggested_friends = array();

    $result_set = Friendship::read_by_query($query);

    global $database;
    while ($row = $database->fetch_array($result_set)) {
        //
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_pic_src = get_profile_pic_src($user_id);

        //
        $user_info = array();
        $user_info["user_id"] = $user_id;
        $user_info["user_name"] = $user_name;
        $user_info["user_pic_src"] = $user_pic_src;

        //
        array_push($all_suggested_friends, $user_info);
    }


    //
    echo json_encode(array("is_result_ok" => true, "all_suggested_friends" => $all_suggested_friends));
}

/**
 * 
 * @global type $session
 * @global type $database
 * @param int $user_id
 * @return string
 */
function get_profile_pic_src($user_id) {
    global $session;

    $query = "SELECT * FROM Profile ";
    $query .= "WHERE user_id = {$user_id}";

    $record_result = Friendship::read_by_query($query);

    global $database;
    
            // Default pic_url.
        $default_url = "/public/_photos/icon_profile.png";


    $num_of_results = $database->get_num_rows_of_result_set($record_result);
    if ($num_of_results == 0) {
        return $default_url;
    }



    while ($row = $database->fetch_array($record_result)) {
        // If there's no valid pic src, then the default pic src,
        // otherwise return the valid pic src.
        if (
                (!isset($row["pic_url"])) ||
                (empty($row["pic_url"])) ||
                (is_null($row["pic_url"])) ||
                (($row["pic_url"] === 0))
            ) 
        {
            $pic_url = $default_url;
        }
        else {
            $pic_url = $row["pic_url"];
        }
        //
        return $pic_url;
    }
}

// TODO:REMINDER: Delete this.
function show_non_friends() {
    //
    global $database;
    global $session;




    //
    $non_friends_records_result_set = User::read_by_query($query);


    // If the code goes here, the query is ok.
    echo "<h4>Suggested Friends</h4>";
    echo "<table id='table_suggested_friends'>";
    while ($row = $database->fetch_array($non_friends_records_result_set)) {
        echo "<tr>";

        echo "<td>";
        $profile_pic_src = LOCAL . get_profile_pic_src($row['user_id']);
        echo "<img src='{$profile_pic_src}'>";
        echo "</td>";

        echo "<td>" . "<h4>{$row['user_name']}</h4>";

//        echo "<br>";


        echo "<input type='hidden' class='form_button' name='friend_id' value='{$row['user_id']}'>";
        echo "</form>";

        echo "</td>";


        // TODO: It is supposed to be like this:
        // TODO: "<td>" . "<a href='friendship_notification_creation.php?friend_id={$row['UserId']}'>add</a>" . "</td>";
//            echo "<td><a>add</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>