<?php

class Road {

    protected $cars;
    public $id;

    public function __construct() {
        $this->cars = array();
        $this->id = uniqid();
    }

    public function getCarSize() {
        return count($this->cars);
    }

    public function putCar(&$car, $time) {
        $this->cars[$time % $GLOBALS['minutes_per_hour']] = $car;
    }

    public function hasCars() {
        return !empty($this->cars);
    }

    protected function getCarsPerHour() {
        $sum = 0;
        foreach ($cars as $c) {
            $sum += $c;
        }
        return $sum;
    }

}

?>