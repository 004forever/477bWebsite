<?php

/**
  Represents an exit point on a highway. This connects via edge classes to other Node objects.
 */
class Node {

    protected $connections;
    public $carBuffer;
    private $id;

    public function __construct() {
        $this->connections = array();
        $this->carBuffer = array();
    }

    public function hasCars() {
        return !empty($this->carBuffer);
    }

    public function addConn(&$con) {
        $this->connections[] = $con;
    }

    public function putCar($car) {
        $this->carBuffer[] = $car;
    }

    public function tick() {
        foreach ($this->carBuffer as $car) {
            if ($car->destination == $this) {
                continue;
            }
            foreach ($this->connections as $conn) {
                if ($car->nextNode == $conn->getEnd()) {
                    $conn->putCar($car);
                    break;
                }
            }
            $this->carBuffer = array();
        }
    }

}

?>