<?php require_once("/Applications/XAMPP/xamppfiles/htdocs/myPersonalProjects/FatBoy/private/includes/initializations.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/session.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_chat.php"); ?>
<?php require_once(PUBLIC_PATH . "/__model/model_profile.php"); ?>
<?php defined("LOCAL") ? null : define("LOCAL", "http://localhost/myPersonalProjects/FatBoy"); ?>




<?php

// Protected page.
//global $session;
if (!$session->is_logged_in() || !$session->is_viewing_own_account()) {
    redirect_to(LOCAL . "/public/index.php");
}
?>





<?php

// TODO: LOG
if (!MyDebugMessenger::is_initialized()) {
    MyDebugMessenger::initialize();
}
?>






<?php

// TODO: SECTION: Functions.
// A chat msg record is considered new
// until it has been seen by all involved in the chat thread (which
// for now is just between 2 users).
function get_new_chat_msgs() {
    global $session;
    $query = "SELECT * FROM ChatMessage ";
    $query .= "WHERE chat_thread_id = {$session->chat_thread_id} ";
    $query .= "AND is_new = 1 ";
    $query .= "ORDER BY date_posted ASC";
//    $query .= "LIMIT 1";

    $record_results = ChatMessage::read_by_query($query);

    return $record_results;
}

function get_user_profile_pic_src($user_id) {
    $query = "SELECT * FROM Profile ";
    $query .= "WHERE user_id = {$user_id}";

    $record_result = Profile::read_by_query($query);

    $pic_url;

    global $database;
    while ($row = $database->fetch_array($record_result)) {
        $pic_url = $row["pic_url"];

        if (empty($pic_url) || is_null($pic_url)) {
            $pic_url = "/public/_photos/mochi.png";
        }

        break;
    }

    return $pic_url;
}

function show_completely_presented_chat_msgs() {
    global $session;
    $query = "SELECT * FROM ChatMessage ";
    $query .= "WHERE chat_thread_id = {$session->chat_thread_id} ";
//    $query .= "AND is_new = 0 ";
    $query .= "ORDER BY date_posted ASC";


    //
    $record_results = ChatMessage::read_by_query($query);


    global $database;
    while ($row = $database->fetch_array($record_results)) {
        // TODO: DEBUG:
        MyDebugMessenger::add_debug_message("Inside method show_completely_presented_chat_msgs()");

        // If the chat_msg is new..
        if ($row["is_new"] == 1) {
            // ..check if it hasn't been seen by the user.
            $current_chat_msg_id = $row["id"];

            // TODO: DEBUG:
            MyDebugMessenger::add_debug_message("VAR \$current_chat_msg_id: {$current_chat_msg_id}");


            $is_log_creation_ok;

            if (!has_user_seen_chat_msg($current_chat_msg_id)) {
                $is_log_creation_ok = create_chat_msg_seen_log_record($current_chat_msg_id);

                // If there's an error, disregard everything.
                if (!$is_log_creation_ok) {
                    return;
                }
            }

            //
            if (has_chat_msg_seen_by_all($current_chat_msg_id)) {
                $is_update_ok = set_chat_msg_old($current_chat_msg_id);

                // Error? Then quit..
                if (!$is_update_ok) {
                    return;
                }
            }
        }



        // If the chat_msg is from the actual user,
        // add the attribute "class=user_chat_post", else
        // "class=chat_post".
        if ($row["chatter_user_id"] == $session->actual_user_id) {
            echo "<div class='chat_post user_chat_post' title='{$row['date_posted']}'>";

            // TODO: uki
            $user_profile_pic_src = get_user_profile_pic_src($row["chatter_user_id"]);
            echo "<img src='" . LOCAL . "{$user_profile_pic_src}' class='chatter_img user_chatter_img'>";
        } else {
            echo "<div class='chat_post' title='{$row['date_posted']}'>";

            //
            $user_profile_pic_src = get_user_profile_pic_src($row["chatter_user_id"]);
            echo "<img src='" . LOCAL . "{$user_profile_pic_src}' class='chatter_img'>";
        }

//        echo "title='{$row['date_posted']}'>";
//        echo "<h5>chatter_user_id: {$row['chatter_user_id']}</h5>";

        $spanned_chat_msg = span_surround_emojis_in_msg($row['message']);

//        echo "<p>{$row['message']}</p>";

        if ($row["chatter_user_id"] == $session->actual_user_id) {
            echo "<p class='actual_user_msg'>{$spanned_chat_msg}</p>";
        } else {
            echo "<p>{$spanned_chat_msg}</p>";
        }


        echo "</div>";
    }
}

function span_surround_emojis_in_msg($chat_msg) {
    $spanned_msg = "";

//    MyDebugMessenger::add_debug_message("<br>chat_msg: {$chat_msg}");

    for ($i = 0; $i < strlen($chat_msg);) {
        if (ord($chat_msg[$i]) > 128) {
            $spanned_msg .= "<span class='span_emoji'>";

            // Html renders html entities/emojis as 2 unicode chars.
            $spanned_msg .= $chat_msg[$i];
            $spanned_msg .= $chat_msg[$i + 1];
            $spanned_msg .= $chat_msg[$i + 2];
            $spanned_msg .= $chat_msg[$i + 3];

            $spanned_msg .= "</span>";

//            // TODO: DEBUG:
//            MyDebugMessenger::add_debug_message("chat_msg[i]: {$chat_msg[$i]}" . ord($chat_msg[$i]));
//            MyDebugMessenger::add_debug_message("chat_msg[i + 1]: {$chat_msg[$i + 1]}" . ord($chat_msg[$i + 1]));
//            MyDebugMessenger::add_debug_message("chat_msg[i + 1]: {$chat_msg[$i + 2]}" . ord($chat_msg[$i + 2]));
//            MyDebugMessenger::add_debug_message("chat_msg[i + 1]: {$chat_msg[$i + 3]}" . ord($chat_msg[$i + 3]));
            // 2 unicode chars added to the_presented_msg, so hop on two chars.
            $i += 4;

            continue;
        }

        // For regular chars, just simply add 'em to the message.
        $spanned_msg .= $chat_msg[$i];
        ++$i;
    }

    return $spanned_msg;
}

function has_user_seen_chat_msg($current_chat_msg_id) {
    global $session;
    $query = "SELECT * FROM ChatMessage ";
    $query .= "INNER JOIN ChatMsgSeenLog ";
    $query .= "ON ChatMessage.id = ChatMsgSeenLog.chat_msg_id ";
    $query .= "WHERE ChatMessage.id = {$current_chat_msg_id} ";
    $query .= "AND ChatMsgSeenLog.seen_by_user_id = {$session->actual_user_id} ";

    $record_results = ChatMessage::read_by_query($query);

    global $database;
    $num_of_results = $database->get_num_rows_of_result_set($record_results);

    if ($num_of_results == 0) {
        return false;
    } else {
        return true;
    }
}

function create_chat_msg_seen_log_record($chat_msg_id) {
    global $session;
    $query = "INSERT INTO ChatMsgSeenLog ";
    $query .= "VALUES ({$chat_msg_id}, {$session->actual_user_id})";

    $is_creation_ok = ChatMessage::create_by_query($query);

    return $is_creation_ok;
}

function has_chat_msg_seen_by_all($chat_msg_id) {
    global $session;
    $query = "SELECT * FROM ChatMsgSeenLog ";
    $query .= "WHERE chat_msg_id = {$chat_msg_id}";

    $record_results = ChatMessage::read_by_query($query);

    global $database;
    $num_of_results = $database->get_num_rows_of_result_set($record_results);

    // TODO: REMINDER: Set this to a variable number that changes depending
    // on the number of chatters involved. For now it's just between 2 chatters,
    // but in the future, update it so that it involves more than 2 chatters.
    $max_num_of_chatters_involved = 2;

    if ($num_of_results == $max_num_of_chatters_involved) {
        return true;
    } else {
        return false;
    }
}

// This for the new-ajax msgs.
function get_completely_presented_chat_msgs() {
    // Get all the records of possible new chat msgs.
    $chat_msg_records = get_new_chat_msgs();

    $completely_presented_chat_msgs = "";
//
    global $session;
    global $database;
    while ($row = $database->fetch_array($chat_msg_records)) {
        // Check if the user has already seen the message.
        $current_chat_msg_id = $row["id"];

        if (has_user_seen_chat_msg($current_chat_msg_id)) {
            // Move on to the next possible new msg to be fetched
            // if it hasn't already been.
            continue;
        } else {
            // If the chat_msg is from the actual user, put a flag code "1" at the
            // very first char of the returned AJAX code.
            // Then just use method substring() to remove it in js.
            if ($row["chatter_user_id"] == $session->actual_user_id) {
                $completely_presented_chat_msgs .= "1";
            } else {
                $completely_presented_chat_msgs .= "0";
            }

            // This is the date. 19 chars long. Just use method subsstring() in AJAX js.
            $completely_presented_chat_msgs .= "{$row['date_posted']}";
//            uki
//            
            // User chat pic.
            if ($row["chatter_user_id"] == $session->actual_user_id) {
                $user_profile_pic_src = get_user_profile_pic_src($row["chatter_user_id"]);
                $completely_presented_chat_msgs .= "<img src='" . LOCAL . "{$user_profile_pic_src}' class='chatter_img user_chatter_img'>";
                $completely_presented_chat_msgs .= "<p class='actual_user_msg'>{$row['message']}</p>";
            } else {
                //
                $user_profile_pic_src = get_user_profile_pic_src($row["chatter_user_id"]);
                $completely_presented_chat_msgs .= "<img src='" . LOCAL . "{$user_profile_pic_src}' class='chatter_img'>";
                $completely_presented_chat_msgs .= "<p>{$row['message']}</p>";
            }




            //
            $is_creation_ok = create_chat_msg_seen_log_record($current_chat_msg_id);

            // If there's a problem, disregard everything and just return an empty AJAX result.
            if (!$is_creation_ok) {
                $completely_presented_chat_msgs = "";
                break;
            }


            //
            if (has_chat_msg_seen_by_all($current_chat_msg_id)) {
                $is_update_ok = set_chat_msg_old($current_chat_msg_id);

                // Again, if there's a problem, quit and return an empty AJAX.
                if (!$is_update_ok) {
                    $completely_presented_chat_msgs = "";
                    break;
                }
            }


            // This though is a successful breakage from the loop.
            // Break out of the loop once we found at least one new msg.
            break;
        }
    }

    //
    return $completely_presented_chat_msgs;
}

function set_chat_msg_old($id) {

    $query = "UPDATE ChatMessage ";
    $query .= "SET is_new = 0 ";
    $query .= "WHERE id = {$id}";

    $is_update_ok = ChatMessage::update_by_query($query);

    return $is_update_ok;
}

function show_friends_to_chat_with() {
    //
    global $database;
    global $session;

    $query = "SELECT * FROM Users WHERE user_id IN ( SELECT friend_id FROM Friendship WHERE user_id = {$session->currently_viewed_user_id})";

    //
    $friends_of_user_records_result_set = User::read_by_query($query);

    echo "<table>";
    while ($row = $database->fetch_array($friends_of_user_records_result_set)) {
        echo "<tr>";
        echo "<td>" . "{$row['user_name']}" . "</td>";

        // Here is the form for authenticating the friendship.
        // In other words, this gives the user the ability to click and view
        // a friends account if they're actually friends.
        echo "<td>";
        echo "<form action='" . LOCAL . "/public/__controller/controller_chat.php' method='post'>";
        echo "<input type='hidden' id='input_chat_with_friend_user_id' name='input_chat_with_friend_user_id' value='{$row['user_id']}'>";
//        echo "<input type='hidden' name='friend_name' value='{$row['user_name']}'>";
        echo "<input type='submit' id='input_chat_with_friend' name='input_chat_with_friend' class='form_button' value='chat'>";
        echo "</form>";
        echo "</td>";

        echo "</tr>";
    }
    echo "</table>";
}

function get_existing_chat_thread($friend_user_id) {
    global $session;
    $query = "SELECT * FROM ChatThread ";
    $query .= "WHERE (initiator_user_id = {$session->actual_user_id} ";
    $query .= "AND responder_user_id = {$friend_user_id}) OR (";
    $query .= "initiator_user_id = {$friend_user_id} ";
    $query .= "AND responder_user_id = {$session->actual_user_id}) LIMIT 1";

//    MyDebugMessenger::add_debug_message("QUERY: {$query}");

    $record_result = ChatMessage::read_by_query($query);

    global $database;
    while ($row = $database->fetch_array($record_result)) {
        return $row["id"];
    }
}

function create_new_chat_thread() {
    global $session;
    $query = "INSERT INTO ChatThread (initiator_user_id, responder_user_id) ";
    $query .= "VALUES ({$session->actual_user_id}, {$_POST['input_chat_with_friend_user_id']})";

    $is_creation_ok = ChatMessage::create_by_query($query);

//    MyDebugMessenger::add_debug_message("QUERY: {$query}");

    if ($is_creation_ok) {
        //    
        global $database;
        $session->set_chat_thread_id($database->get_last_inserted_id());

        MyDebugMessenger::add_debug_message("SUCCESS Creation of new chat thread.");
    } else {
        MyDebugMessenger::add_debug_message("FAIL Creation of new chat thread.");
    }
}

function does_chat_thread_exist($friend_user_id) {
    global $session;
    $query = "SELECT * FROM ChatThread ";
    $query .= "WHERE (initiator_user_id = {$session->actual_user_id} ";
    $query .= "AND responder_user_id = {$friend_user_id}) OR (";
    $query .= "initiator_user_id = {$friend_user_id} ";
    $query .= "AND responder_user_id = {$session->actual_user_id}) LIMIT 1";

//    MyDebugMessenger::add_debug_message("QUERY: {$query}");

    $record_result = ChatMessage::read_by_query($query);

    global $database;
    $num_of_result = $database->get_num_rows_of_result_set($record_result);

    if ($num_of_result == 1) {
        return true;
    } else {
        return false;
    }
}
?>






<?php

if (isset($_POST["chat_msg"])) {
    global $session;

    $new_chat_msg = new ChatMessage();
    $new_chat_msg->id = null;
    $new_chat_msg->chat_thread_id = $session->chat_thread_id;
    $new_chat_msg->chatter_user_id = $session->actual_user_id;
    $new_chat_msg->message = $_POST["chat_msg"];
    $is_creation_ok = $new_chat_msg->create_with_bool();

//    $query = "INSERT INTO TestHtmlEntities VALUES(NULL, '{$_POST['chat_msg']}')";
//    $is_creation_ok = TestHtmlEntities::create_by_query($query);

    if ($is_creation_ok) {
        echo "SUCCESS posting chat to db.";
    } else {
        echo "FAIL posting chat to db.";
    }
}

if (isset($_POST["chat_msg_fetcher"])) {
    echo get_completely_presented_chat_msgs();
}

// If chat button is clicked...
if (isset($_POST["input_chat_with_friend"])) {
    global $session;

    // Check if there's already an existing chat thread for the 2 users.
    if (does_chat_thread_exist($_POST["input_chat_with_friend_user_id"])) {
        MyDebugMessenger::add_debug_message("Chat thread exists.");

        // Get the thread id.
        $session->set_chat_thread_id(get_existing_chat_thread($_POST["input_chat_with_friend_user_id"]));

        MyDebugMessenger::add_debug_message("\$session->chat_thread_id: {$session->chat_thread_id}");
    }
    else {
        MyDebugMessenger::add_debug_message("Chat thread doesn't exist.");

        //
        create_new_chat_thread();

        MyDebugMessenger::add_debug_message("\$session->chat_thread_id: {$session->chat_thread_id}");
    }

    redirect_to(LOCAL . "/public/__view/view_chat/index.php?content_page=2");
}
?>
