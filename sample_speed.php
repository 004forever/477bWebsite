<?php
//after buy traffic data replace this with wrappper to traffx
$ar = array();

for($i = 0 ; $i != 138; ++$i){
$ar[]= rand(1000,8000)/100;
}
echo json_encode($ar);


?>