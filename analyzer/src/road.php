<?php

class Road{

    protected $cars;
    
    public function __construct() {
        $this->cars = array();
    }
    
    public function putCar(&$car) {
        $this->cars[] = $car;
    }
    
    public function hasCars() {
        return !empty($this->cars);
    }
}

?>