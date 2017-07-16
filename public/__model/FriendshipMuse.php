<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-07-13
 * Time: 17:17
 */

namespace App\Publico\Model;

require_once(PUBLIC_PATH . "/__model/Friendship.php");

use App\Publico\Model\Friendship;


class FriendshipMuse extends Friendship
{
    public static function read_by_section($section)
    {
        //uki
        $query = self::get_query_for_muse_friends();


        // Array that contains all the info of each suggested friends.
        $muse_friends = array();

        $result_set = parent::read_by_query($query);

        global $database;
        while ($row = $database->fetch_array($result_set)) {
            //
            $user_id = $row['user_id'];
            $user_name = $row['user_name'];
//            $user_pic_src = parent::get_profile_pic_src($user_id);
            $user_pic_src = self::get_sanitized_profile_pic_src($row['pic_url']);

            //
            $user_info = array();
            $user_info["user_id"] = $user_id;
            $user_info["user_name"] = $user_name;
            $user_info["user_pic_src"] = $user_pic_src;

            //
            array_push($muse_friends, $user_info);
        }


        //
        return $muse_friends;
    }


    public static function get_query_for_muse_friends()
    {
        //
        global $session;

        $query = "SELECT Users.user_id, user_name, pic_url";
        $query .= " FROM Users";

        // For the pic_url.
        $query .= " INNER JOIN Profile ON";
        $query .= " Users.user_id = Profile.user_id";

        $query .= " WHERE Users.user_id IN ( SELECT user_id FROM Friendship WHERE friend_id = {$session->currently_viewed_user_id})";


        //
        \MyDebugMessenger::add_debug_message("VAR:\$query for METHOD:get_query_for_muse_friends(): {$query}");

        return $query;
    }
}