<?php

class Edge{

private $start;//start node
private $end;
private $distance;//distance in miles
private $cars;
private $cars_per_hour;

public function __construct($s,$e,$d){
$this->start=$s;
$this->end=$e;
$this->cars = array();
$this->cars_per_hour=0;
}
public function getEnd(){
return $this->end;
}
public function tick(){
$keys = array();
foreach($this->cars as $k=> $c){
$c->edgeLength -= $this->getSpeed()/60*$GLOBALS['tick_time_s'];
if($c->edgeLength <= 0){
$this->end->putCar($c);
$keys[] = $k;
}
}
$this->cars = Utils::arr_rm($this->cars,$keys);
}
public function putCar($car){
$car->edgeLength = $this->distance;
$this->cars[]=$car;
}
public function getSpeed(){
if($this->cars_per_hour == 0){
return $GLOBALS['max_mph'];
}
$speed = (count($this->cars)/distance/$this->cars_per_hour);
return $speed > $GLOBALS['max_mph'] ? $GLOBALS['max_mph'] : $speed; 
}

}

?>