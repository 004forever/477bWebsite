<?php

class Edge extends Road {

    private $start; //start node
    public $end;
    private $distance; //distance in miles
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

    public function putCar(&$car,$time) {
        $car->edgeLength = $this->distance;
        parent::putCar($car);
        $this->running_per_hour++;
    }

    public function tick($time) {
        $keys = array();
        foreach ($this->cars as $k => &$c) {
            $c->edgeLength -= $this->getSpeed() / 60 * $GLOBALS['tick_time_s'];
            if ($c->edgeLength <= 0) {
                $this->end->putCar($c);
                $keys[] = $k;
                Utils::debug_echo('car reached end of edge and will move to ' . $this->end->id . ' on the way to ' . $c->nextNode()->id . ' at time ' . $time);
            }
        }
        $this->cars = Utils::arr_rm($this->cars, $keys);
    }

    public function getSpeed() {
        $cph = $this->getCarsPerHour();
        if ($cph == 0) {
            return $GLOBALS['max_speed_mph'];
        }
        $speed = (count($this->cars) / $this->distance / $cph);
        return $speed > $GLOBALS['max_speed_mph'] ? $GLOBALS['max_speed_mph'] : $speed;
    }

}

?>