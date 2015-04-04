<?php

class Utils {

    public static function arr_rm($array, $keys) {
        foreach ($keys as $k) {
            unset($array[k]);
        }
        return array_values($array);
    }
    public static function debug_echo($msg){
        if($GLOBALS['debug']){
         echo $msg."\n";   
        }
    }

}

?>