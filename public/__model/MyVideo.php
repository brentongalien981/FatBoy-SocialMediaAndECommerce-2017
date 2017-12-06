<?php
/**
 * Created by PhpStorm.
 * User: ops
 * Date: 2017-11-26
 * Time: 00:30
 */

namespace App\Publico\Model;

require_once(PUBLIC_PATH . "/__model/MainModel.php");

use App\Publico\Model\MainModel;


class MyVideo extends MainModel
{
    /** @override */
    protected static function init() {
        self::$db_fields = array(
            "id",
            "user_id",
            "title",
            "src",
            "rating",
            "created_at",
            "updated_at"
        );

        self::$table_name = "MyVideos";
    }

    public function __construct()
    {
        self::init();

        parent::__construct();
    }

    public function fetch($data)
    {


        global $session;
        $limit = 5;

        //
        $q = "SELECT * FROM " . self::$table_name;
        $q .= " WHERE user_id = {$session->currently_viewed_user_id}";
        $q .= " AND created_at > '{$data['date_of_latest_obj']}'";
        $q .= " ORDER BY id DESC";
        $q .= " LIMIT {$limit}";

        //
        $result_set = self::read_by_query($q);


        global $database;
        $array_of_objs = array();

        while ($row = $database->fetch_array($result_set)) {
            $an_obj = self::instantiate($row);

            //
            array_push($array_of_objs, $an_obj);
        }

        return $array_of_objs;
    }

    public function read($data)
    {

        global $session;
        $limit = 5;

        //
        $q = "SELECT * FROM " . self::$table_name;
        $q .= " WHERE user_id = {$session->currently_viewed_user_id}";
        $q .= " ORDER BY id DESC";
        $q .= " LIMIT {$limit}";

        //
        $result_set = self::read_by_query($q);


        global $database;
        $array_of_objs = array();

        while ($row = $database->fetch_array($result_set)) {
            $an_obj = self::instantiate($row);

            //
            array_push($array_of_objs, $an_obj);
        }

        return $array_of_objs;
    }

    public function update($data)
    {

        global $session;
        global $database;

        self::$table_name = "MyVideos";

        //
        $q = "UPDATE " . self::$table_name;
        $q .= " SET title = '{$data['video_title']}',";
        $q .= " src = '{$data['video_url']}',";
        $q .= " updated_at = 'CURRENT_TIMESTAMP'";
        $q .= " WHERE id = {$data['video_id']}";

        //
        $q = self::update_query_with_current_time_stamp($q);

        //
        $result_set = self::read_by_query($q);

        if (!$result_set) { return false; }

        //
        return ($database->get_num_of_affected_rows() == 1) ? true : false;
    }


    public function delete($data)
    {

        global $session;
        global $database;

        self::$table_name = "MyVideos";

        //
        $q = "DELETE FROM " . self::$table_name;
        $q .= " WHERE id = {$data['video_id']}";
        $q .= " LIMIT 1";


        //
        $database->get_result_from_query($q);
        return ($database->get_num_of_affected_rows() == 1) ? true : false;
    }
}