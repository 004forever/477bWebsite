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

    public function putCar(&$car) {
        $this->cars[] = $car;
    }

    public function hasCars() {
        return !empty($this->cars);
    }


}

?>