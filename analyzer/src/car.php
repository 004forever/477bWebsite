<?php

class Car {

    public $destination;
    public $path;

    public function __construct(&$destination) {
        $this->destination = $destination;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function &nextNode() {
        return $this->path[0];
    }
}
    public function popNode() {
        //fuck you PHP and you stupid pass by value bullshit, 
        //worse language ever for doing this kind of shit
        unset($this->path[0]);
        $this->path = array_values($this->path);
    }

}

?>