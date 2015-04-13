<?php

class Edge extends Road {

    private $start; //start node
    public $end;
    public $distance; //distance in miles
    private $cars_per_hour;
    
    private $running_per_hour;
    
    private $returnSpeeds = array();
    private $time = 0;

    public function __construct(&$s, &$e, $d) {
        parent::__construct();
        $this->start = &$s;
        $this->start->addConn($this);
        $this->end = &$e;
        $this->cars_per_hour = 0;
        
        $running_per_hour = 0;
        $this->distance = $d;
        $this->time = 0;
    }

    public function &getEnd() {
        return $this->end;
    }

    public function putCar(&$car) {
        $car->edgeLength = $this->distance;
        parent::putCar($car);
        $this->running_per_hour++;
    }

    public function tick() {
        $keys = array();
        /*if($this->time%60 == 0)
        {
            $this->cars_per_hour = $this->running_per_hour;
            $running_per_hour = 0;
        }*/
        $this->time = $this->time+1;
        if($this->time%60 == 0){
            $this->returnSpeeds[] = $this->getSpeed();
        }
        foreach ($this->cars as $k => &$c) {
            $c->edgeLength -= $this->getSpeed() / 60 * $GLOBALS['tick_time_s'];
            if ($c->edgeLength <= 0) {
                $this->end->putCar($c);
                $keys[] = $k;
                Utils::debug_echo('car reached end of edge and will move to ' . $this->end->id.' on the way to '.$c->nextNode()->id.' at time '.$this->time);
            }
        }
        $this->cars = Utils::arr_rm($this->cars, $keys);
    }
    
    public function returnSpeeds()
    {
        return $this->returnSpeeds;
    }

    public function getSpeed() {
        if ($this->cars_per_hour == 0) {
            return $GLOBALS['max_speed_mph'];
        }
        $speed = (count($this->cars) / distance / $this->cars_per_hour);
        return $speed > $GLOBALS['max_speed_mph'] ? $GLOBALS['max_speed_mph'] : $speed;
    }
}

?>