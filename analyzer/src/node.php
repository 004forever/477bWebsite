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
            echo 'car from ' . $this->id . ' to ' . $car->destination->id . ': ';
            foreach ($car->path as $node) {
                echo $node->id . ',';
            }
            echo "\n";
        }
    }

    public function tick() {
        //echo 'node '.$this->id.' is ticking';
        foreach ($this->cars as &$car) {
            if ($car->destination == $this) {
                Utils::debug_echo('car reached destination at ' . $this->id);
                continue;
            }
            $car->popNode();
            $found = false;
            foreach ($this->connections as &$conn) {
                if ($car->nextNode() == $conn->getEnd()) {
                    Utils::debug_echo('car moving to next edge ' . $conn->id);
                    $conn->putCar($car);
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                echo 'could not find path for car from node ' . $this->id . ' to ' . $car->destination->id.' expecting next node to be '.$car->nextNode()->id."\n";
                $this->printStatus();
                die();
            } 
        }
        $this->cars = array();
    }

    public function printStatus() {
        echo 'node ' . $this->id . ' with ' . $this->getCarSize() . ' cars: ' . "\n";
        foreach ($this->connections as $con) {
            echo "\tconnection id ".$con->id." to " . $con->end->id . " with " . $con->getCarSize() . " cars enroute\n";
        }
    }

}

?>