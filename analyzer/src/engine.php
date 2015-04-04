<?php

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
            if ($this->noCarsInSystem()) {
                break;
            }
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