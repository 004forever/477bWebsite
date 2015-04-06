g<?php

class Engine {

    private $edges;
    private $nodes;

    public function __construct() {
        $this->edges = array();
        $this->nodes = array();
    }

    public function addEdge($e) {
        $this->edges[] = $e;
    }

    public function addNode($n) {
        $this->nodes[] = $n;
    }

    public function start() {
        while (true) {
            echo "tick\n";
            $this->tick();
            //$this->printStatus();
            if ($this->noCarsInSystem()) {
                break;
            }
        }
    }

    public function printStatus() {
        foreach ($this->nodes as $n) {
            echo 'node ' . $n->id . ' with ' . $n->getCarSize() . ' cars: ' . "\n";
            foreach ($n->connections as $con) {
                echo "\tconnected to " . $con->end->id . "\n";
            }
        }
    }

    public function resetDiscovered() {
        foreach ($this->nodes as &$n) {
            $n->discovered = false;
        }
    }

    public function autoRoute() {
        foreach ($this->nodes as &$n) {
            $n->autoRoute($this);
        }
    }

    public function printAllRoutes() {
        foreach ($this->nodes as $n) {
            $n->printAllRoutes();
        }
    }

    private function noCarsInSystem() {
        foreach ($this->nodes as $n) {
            if ($n->hasCars()) {
                return false;
            }
        }
        foreach ($this->edges as $n) {
            if ($n->hasCars()) {
                return false;
            }
        }
        return true;
    }

    public function tick() {
        foreach ($this->edges as $e) {
            $e->tick();
        }
        foreach ($this->nodes as $n) {
            $n->tick();
        }
    }

}
?>