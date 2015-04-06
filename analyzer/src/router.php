Ï<?php

class Router {

    public static function shortestPath(&$car, &$start) {
        return array_reverse(Router::dfs($car->destination, $start));
    }

    public static function dfs(&$dest, &$cur) {
        $cur->discovered = true;
        foreach ($cur->connections as &$conn) {
            $a = dfs($dest, $conn->end);
            if ($a) {
                $a[] = $cur;
                return $a;
            }
        }
        return null;
    }

}
?>