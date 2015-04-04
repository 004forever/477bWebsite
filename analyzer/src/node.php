<?php

/**
  Represents an exit point on a highway. This connects via edge classes to other Node objects.
 */
class Node extends Road{

    protected $connections;
    private $id;

    public function __construct() {
        parent::__construct();
        $this->connections = array();
    }

    public function addConn(&$con) {
        $this->connections[] = $con;
    }

    public function tick() {
        foreach ($this->cars as $car) {
            if ($car->destination == $this) {
                Utils::debug_echo('car reached destination');
                continue;
            }
            foreach ($this->connections as $conn) {
                if ($car->nextNode == $conn->getEnd()) {
                    Utils::debug_echo('car moving to next edge');
                    $conn->putCar($car);
                    break;
                }
            }
            $this->cars = array();
        }
    }

}

?>