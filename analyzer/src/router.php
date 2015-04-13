<?php

class Router {
    
    public static function shortestPath(&$car, &$start) {
        return array_reverse(Router::dfs($car->destination, $start));
    }

    public static function dfs(&$dest, &$cur) {
        if ($cur == $dest) {
            return array($dest);
        }
        $cur->discovered = true;
        foreach ($cur->connections as &$conn) {
            if ($conn->discovered == false) {
                $a = Router::dfs($dest, $conn->end);
                if ($a) {
                    $a[] = $cur;
                    return $a;
                }
            }
        }
        return null;
    }

}
?>