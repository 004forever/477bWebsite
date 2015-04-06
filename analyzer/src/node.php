<?php

/**
  Represents an exit point on a highway. This connects via edge classes to other Node objects.
 */
class Node extends Road {

    public $connections;
    public $discovered;

    public function __construct() {
        parent::__construct();
        $this->connections = array();
    }

    public function addConn(&$con) {
        $this->connections[] = $con;
    }

    public function autoRoute(&$engine) {
        foreach ($this->cars as &$car) {
            $engine->resetDiscovered();
            $car->setPath(Router::shortestPath($car, $this));
        }
    }

    public function printAllRoutes() {
        foreach ($this->cars as $car) {
            echo 'car from '.$this->id.' to '.$car->destination->id.': ';
            foreach ($car->path as $node) {
                echo $node->id . ',';
            }
            echo "\n";
        }
    }

    public function tick() {
        foreach ($this->cars as $car) {
            if ($car->destination == $this) {
                Utils::debug_echo('car reached destination at ' . $this->id);
                continue;
            }
            foreach ($this->connections as $conn) {
                if ($car->nextNode() == $conn->getEnd()) {
                    Utils::debug_echo('car moving to next edge ' . $conn->id);
                    $conn->putCar($car);
                    break;
                }
            }
        }
        $this->cars = array();
    }

}

?>