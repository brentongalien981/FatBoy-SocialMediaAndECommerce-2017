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


class FriendshipSuggestion extends Friendship
{
    public static function read_by_section($section)
    {
        //
        $query = self::get_query_for_suggested_friends();


        // Array that contains all the info of each suggested friends.
        $all_suggested_friends = array();

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
            array_push($all_suggested_friends, $user_info);
        }


        //
        return $all_suggested_friends;
    }


    public static function get_query_for_suggested_friends()
    {
        //
        global $session;

        $query = "SELECT Users.user_id, user_name, pic_url ";
//        $query = "SELECT Users.user_id, user_name ";
        $query .= "FROM Users ";

        // For the pic_url.
        $query .= "INNER JOIN Profile ON ";
        $query .= "Users.user_id = Profile.user_id ";

        // Don't show users that are already my followers
        // cause they already appear on my Followers section.
        $query .= "WHERE Users.user_id NOT IN ";
        $query .= "(";
        $query .= "SELECT friend_id ";
        $query .= "FROM Friendship ";
        $query .= "WHERE user_id = {$session->actual_user_id}";
        $query .= ") ";
        $query .= "AND Users.user_id != {$session->actual_user_id} ";

        // Don't show users that are already my muses
        // cause they already appear on my Muses section.
        $query .= "AND Users.user_id NOT IN (";
        $query .= "SELECT user_id ";
        $query .= "FROM Friendship ";
        $query .= "WHERE friend_id = {$session->actual_user_id}) ";

        // Also, don't suggest users that are currently in pending friendship status with you.
        $query .= "AND Users.user_id NOT IN (";
        $query .= "SELECT notified_user_id ";
        $query .= "FROM Notifications ";
        $query .= "WHERE notifier_user_id = {$session->actual_user_id} ";
        $query .= "AND notification_msg_id IN (2, 3)) ";

        $query .= "AND Users.user_id NOT IN (";
        $query .= "SELECT notifier_user_id ";
        $query .= "FROM Notifications ";
        $query .= "WHERE notified_user_id = {$session->actual_user_id} ";
        $query .= "AND notification_msg_id IN (2, 3))";


        //
        \MyDebugMessenger::add_debug_message("VAR:\$query: {$query}");

        return $query;
    }


    public static function get_sanitized_profile_pic_src($pic_url)
    {
        // Default pic_url.
        $default_url = "/public/_photos/icon_profile.png";


        // If there's no valid pic src, then the default pic src,
        // otherwise return the valid pic src.
        if (
            (!isset($pic_url)) ||
            (empty($pic_url)) ||
            (is_null($pic_url)) ||
            (($pic_url === 0)))
        {
            $pic_url = $default_url;
        }

        //
        return $pic_url;

    }
}