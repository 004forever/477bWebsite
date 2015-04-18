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
        $this->cars[$time % $GLOBALS['minutes_per_hour']][] = $car;
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
     
     *The problem with this equation is that it assumes we know the actual flow for the road in the real world, but we're calculating it based on how many cars we happen to send down the road.  So if 1 car is sent down, the flow is calculated to be 1 car per hour.  If we send a billion cars down the road, it's calculated to be 1 billion cars per hour.  
     */

    public function getSpeed() {
        //putting this back to avoid divide by zero issues for now
        if($this->getCarSize() == 0)
            $speed = 70;
        else
            $speed = 10;
        //$speed = $GLOBALS['max_speed_mph']*(1-$this->getCarSize()/(1056*$this->distance));
        return $speed;
        $v = $this->getCarsPerHour();
        $d = $this->getCarSize() / $this->distance;
        echo $v." ".$d;
        $s = $v / $d;
        return $s > $GLOBALS['max_speed_mph'] ? $GLOBALS['max_speed_mph'] : $s;
    }

}

?>