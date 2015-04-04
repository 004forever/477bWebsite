<?php
/**
Represents an exit point on a highway. This connects via edge classes to other Node objects.
*/
class Node{

protected $connections;
public $carBuffer;
public function __construct(){
$this->connections = array();
$this->carBuffer=array();
}

public function addConn($con)
{
$this->connections[] = $con;
}
public function tick(){
foreach($carBuffer as $car){
if($car->destination == $this){
continue;
}
foreach($connections as $conn){
if($car->nextNode = $conn->getEnd()){
$conn->putCar($car);
break;
}
}
$this->carBuffer = array();
}
}
}

?>