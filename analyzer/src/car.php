<?php

class Car {

    public $destination;
public $path;
    
    public function __construct($destination) {
        $this->destination = $destination;
    }
    public function setPath($path){
     $this->path=$path;   
    }
public function nextNode(){
 return $this->path[0];   
}
}

?>