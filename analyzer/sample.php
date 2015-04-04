<?php

require_once(__DIR__.'/autoload.php');

$GLOBALS['tick_time_s']=1;//1 second per tick
$GLOBALS['max_speed_mph']=70;//70mph is max speed

$engine = new Engine();

$node1 = new Node();
$node2 = new Node();
$node3 = new Node();
$node4 = new Node();

$edge1 = new Edge($node1,$node2,1);
$edge2 = new Edge($node2,$node3,.5);
$edge3 = new Edge($node3,$node4,3);

$car = new Car($node4);
$car->setPath(array($node2,$node3,$node4));
$node1->putCar($car);
$car = new Car($node4);
$car->setPath(array($node2,$node3,$node4));
$node1->putCar($car);
$car = new Car($node4);
$car->setPath(array($node2,$node3,$node4));
$node1->putCar($car);
$car = new Car($node4);
$car->setPath(array($node4));
$node3->putCar($car);

$engine->addNode($node1);
$engine->addNode($node2);
$engine->addNode($node3);
$engine->addNode($node4);

$engine->addEdge($edge1);
$engine->addEdge($edge2);
$engine->addEdge($edge3);

$engine->start();

echo 'done';

?>