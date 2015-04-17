<?php

class Router {
    
    public static function shortestPath(&$car, &$start) {
        
        session_start();
        $_SESSION['user_id'] = 0;
        $_SESSION['selection'] = 'Weekend';
        $con=mysql_connect("localhost","four","password");
        if (!$con) {
            die('Could not connect to MySQL: ' . mysql_error());
        }
        else{
            if ( !mysql_select_db("477b"))
            {
                echo "Can't connect to 477b";
            }
        }
        
        $check = mysql_query("SELECT max_freeway_speed FROM runs WHERE user_id='".$_SESSION['user_id']."' AND name = '".$_SESSION['selection']."'");
        $row = mysql_fetch_row($check);
        $algorithm=$row[0];
        if($algorithm == 1)
            return array_reverse(Router::dfs($car->destination, $start));
        return array_reverse(Router::optimal($car->destination, $start));
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
    
    public static function allDfs(&$dest, &$cur) {
        if ($cur == $dest) {
            $cur->discovered = true;
            return array(array($dest));
        }
        if($cur->discovered == true)
            return null;
        $list = array();
        $holder;
        $cur->discovered = true;
        foreach ($cur->connections as &$conn) {
            if ($conn->discovered == false) {
                $a = Router::allDfs($dest, $conn->end);
                if ($a) {
                    for($i = 0;$i < count($a);$i++)
                    {
                        $holder = $a[$i];
                        $holder[] = $cur;
                        $a[$i] = $holder;
                        $list[] = $a[$i];
                    }
                }
            }
        }
        $cur->discovered = false;
        if(count($list) != 0)
        {
            return $list;
        }
        return null;
    }
    
    public static function getLength(&$path)
    {
        $count = 0;
        for($i = 1;$i < count($path);$i++){
            for($j = 0;$j < count($path[$i-1]->connections);$j++)
            {
                if($path[$i-1]->connections[$j]->end == $path[$i])
                {
                    $count+=$path[$i-1]->connections[$j]->distance;
                }
            }
        }
        return $count;
    }
    
    public static function optimal(&$dest, &$cur)
    {
        $list = Router::allDfs($dest, $cur);
        $min = -1;
        $minDist = 0;
        $dist;
        $entry;
        for($i = 0;$i < count($list);$i++)
        {
            $dist = Router::getLength(array_reverse($list[$i]));
            if($dist < $minDist || $minDist ==0)
            {
                $min = $i;
                $minDist = $dist;
            }
        }
        $rand = rand(0, count($list)-1);
        $entry = $list[$min];//$min
        $list = null;
        return $entry;
    }

}
?>