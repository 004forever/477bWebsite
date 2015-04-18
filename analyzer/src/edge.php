<?php
    class Edge extends Road {
        private $start; //start node
        public $end;
        public $distance; //distance in miles
        private $car_history;
        public function __construct(&$s, &$e, $d) {
            parent::__construct();
            $this->start = &$s;
            $this->start->addConn($this);
            $this->end = &$e;
            $this->car_history = array();
            $this->distance = $d;
        }
        public function &getEnd() {
            return $this->end;
        }
        protected function getCarsPerHour() {
            $sum = 0;
            foreach ($this->car_history as $v) {
                foreach($v as $c) {
                    $sum += count($c);
                }
            }
            return $sum;
        }
        public function putCar(&$car, $time) {
            echo "happened";
            $car->edgeLength = $this->distance;
            $this->car_history[$time % $GLOBALS['minutes_per_hour']][] = $car; //here's your problem
            parent::putCar($car);
        }
        public function tick($time) {
            $this->car_history[$time % $GLOBALS['minutes_per_hour']] = array();
            $keys = array();
            foreach ($this->cars as $k => $c) {
                $c->edgeLength -= $this->getSpeed() / 60 * $GLOBALS['tick_time_s'];
                if ($c->edgeLength <= 0) {
                    $this->end->putCar($c);
                    $keys[] = $k;
                    Utils::debug_echo('car reached end of edge and will move to ' . $this->end->id . ' on the way to ' . $c->nextNode()->id . ' at time ' . $time);
                }
            }
            $this->cars = Utils::arr_rm($this->cars, $keys);
        }
        /*
         * Flow (V) = Number of vehicles passing a certain point during a given time period, in vehicles per hour (veh / hr)
         * Speed (S) = The rate at which vehicles travel (mph)
         * Density (D) = Number of vehicles occupying a certain space. Given as veh / mi.
         * Density = Flow/Speed
         * Therefore Speed = Flow/Density
         */
        public function getSpeed() {
            //$speed = $GLOBALS['max_speed_mph']*(1-$this->getCarSize()/(528*$this->distance));
            //return $speed;
            if($this->getCarSize() == 0)
                return $GLOBALS['max_speed_mph'];
            $v = $this->getCarsPerHour();
            $d = $this->getCarSize() / $this->distance;
            $s = $v / $d;
            return $s > $GLOBALS['max_speed_mph'] ? $GLOBALS['max_speed_mph'] : $s;
        }
    }
    ?>

