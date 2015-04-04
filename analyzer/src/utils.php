<?php

class Utils {

    public static function arr_rm($array, $keys) {
        echo 'array size '.count($array).' to remove '.count(keys);
        foreach ($keys as $k) {
            unset($array[k]);
        }
        echo ' yields size '.count($array);
        return array_values($array);
    }
    public static function debug_echo($msg){
        if($GLOBALS['debug']){
         echo $msg."\n";   
        }
    }

}

?>