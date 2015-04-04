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

        $done = false;
        while (!$done) {
            $done = true;
            $this->tick();
            foreach ($this->nodes as $n) {
                if ($n->hasCars()) {
                    $done = false;
                    break;
                }
            }
        }
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