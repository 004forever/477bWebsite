<?php

class Utils {

    public static function arr_rm($array, $keys) {
        return array_diff_key($array,array_flip($keys));
    }
    public static function debug_echo($msg){
        if($GLOBALS['debug']){
         echo $msg."\n";   
        }
    }

}

?>