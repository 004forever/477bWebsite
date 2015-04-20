<?php

Utils::load_defaults(); //sets globals if not set manually

class Engine {

    private $edges;
    private $nodes;
    private $time;
    private $speed_info;

    public function __construct() {
        $this->edges = array();
        $this->nodes = array();
        $this->speed_info = array();
        $this->time = 0;
    }

    public function addEdge($e) {
        $this->edges[] = $e;
    }

    public function addNode($n) {
        $this->nodes[] = $n;
    }

    public function start() {
        while (true) {
            Utils::debug_echo("tick ");
            $this->tick();
            $this->printStatus();
            if ($this->noCarsInSystem()) {
                break;
            }
        }
    }

    public function printStatus() {
        foreach ($this->nodes as $n) {
            $n->printStatus();
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
        //$timer = microtime(true);
        //$start = microtime(true);
        foreach ($this->edges as $e) {
            $e->tick($this->time);
        }
        //echo "$-".(microtime(true) - $start);
        //$start = microtime(true);
        foreach ($this->nodes as $n) {
            $n->tick($this->time);
        }
        //echo "@-".(microtime(true) - $start);
        //$start = microtime(true);
        $this->speed_info[] = $this->gatherSpeedInfo();
        $this->time++;
    }

    public function getJsonResults() {
        return json_encode($this->getResults());
    }

    public function getResults() {
        return $this->speed_info;
    }

    private function gatherSpeedInfo() {
        $result = array();
        foreach ($this->edges as $e) {
            $result[] = $e->getSpeed();
        }
        return $result;
    }

}

?>