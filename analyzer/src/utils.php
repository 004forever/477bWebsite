<?php

class Utils {

    public static function arr_rm($array, $keys) {
        return array_diff_key($array, array_flip($keys));
    }

    public static function debug_echo($msg) {
        if ($GLOBALS['debug']) {
            echo $msg . "\n";
        }
    }

    public static function load_defaults() {
        $kv = array(
            'tick_time_s' => 1,
            'max_speed_mph' => 70,
            'debug' => true,
            'minutes_per_hour', 60
        );
        foreach ($kv as $k => $v) {
            Utils::set_default($k, $v);
        }
    }

    private static function set_default($key, $value) {
        if (!isset($GLOBALS[$key])) {
            $GLOBALS[$key] = $value;
        }
    }

}

?>