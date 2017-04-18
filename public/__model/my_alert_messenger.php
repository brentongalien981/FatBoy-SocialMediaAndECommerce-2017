<?php

class MyAlertMessenger {
    private static $num_of_alert_messages = 0;
    private static $alert_messages_array = array();


    public static function add_alert_message($additional_alert_message) {
        array_push(self::$alert_messages_array, "<br>{$additional_alert_message}<br>");
        
        self::$num_of_alert_messages++;        
    }
    
    public static function has_alert_message() {
        if (self::$num_of_alert_messages === 0) {
            return false;
        }
        else {
            return true;
        }
    }

    
    public static function show_alert_messages() {
        $alert_msg = "<script>window.alert('";
        
        foreach (self::$alert_messages_array as $alert) {
            $alert_msg .= $alert;
        }
        
        $alert_msg .= "');</script>";
        
        self::$num_of_alert_messages = 0;
        
        
        //
        echo $alert_msg;
    }

}
?>

