<?php

class Edge extends Road {

    private $start; //start node
    public $end;
    public $distance; //distance in miles
    private $running_per_hour;

    public function __construct(&$s, &$e, $d) {
        parent::__construct();
        $this->start = &$s;
        $this->start->addConn($this);
        $this->end = &$e;

        $this->running_per_hour = 0;
        $this->distance = $d;
    }

    public function &getEnd() {
        return $this->end;
    }

    public function getCarSize() {
        $sum = 0;
        foreach ($this->cars as $car) {
            $sum += count($car);
        }
        return $sum;
    }

    protected function getCarsPerHour() {
        $sum = 0;
        foreach ($this->cars as $c) {
            $sum += $c;
        }
        return $sum;
    }

    public function putCar(&$car, $time) {
        $car->edgeLength = $this->distance;
        $this->cars[$time % $GLOBALS['minutes_per_hour']][] = $car; //here's your problem
        $this->running_per_hour++;
    }

    public function tick($time) {
        $this->cars[$time % $GLOBALS['minutes_per_hour']] = array();
        $keys = array();
        foreach ($this->cars as $key => $car) {
            foreach ($car as $k => &$c) {
                $c->edgeLength -= $this->getSpeed() / 60 * $GLOBALS['tick_time_s'];
                if ($c->edgeLength <= 0) {
                    $this->end->putCar($c);
                    $keys[] = $k;
                    Utils::debug_echo('car reached end of edge and will move to ' . $this->end->id . ' on the way to ' . $c->nextNode()->id . ' at time ' . $time);
                }
            }
            $this->cars = Utils::arr_rm($this->cars[$key], $keys);
        }
    }

    /*
     * Flow (V) = Number of vehicles passing a certain point during a given time period, in vehicles per hour (veh / hr)
     * Speed (S) = The rate at which vehicles travel (mph)
     * Density (D) = Number of vehicles occupying a certain space. Given as veh / mi.
     * Density = Flow/Speed
     * Therefore Speed = Flow/Density
     */

    public function getSpeed() {
        $v = $this->getCarsPerHour();
        $d = $this->getCarSize() / $this->distance;
        $s = $v / $d;
        return $s > $GLOBALS['max_speed_mph'] ? $GLOBALS['max_speed_mph'] : $s;
    }

}

?>