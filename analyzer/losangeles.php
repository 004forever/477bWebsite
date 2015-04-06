<?php

require_once(__DIR__.'/autoload.php');

$GLOBALS['tick_time_s']=1;//1 second per tick
$GLOBALS['max_speed_mph']=70;//70mph is max speed
$GLOBALS['debug']=true;

    
    $node = array();
    $edge = array();
    
    for($i = 0;$i < 67;$i++)
    {
        $node[$i] = new Node();
    }
    
    $edge[0] = new Edge($node[0],$node[1],1.209188340093852);
    $edge[1] = new Edge($node[1], $node[2], 1.56523);
    $edge[2] = new Edge($node[2], $node[3], 4.94177);
    $edge[3] = new Edge($node[3], $node[4], 2.34195);
    $edge[4] = new Edge($node[4], $node[5], 4.56459);
    $edge[5] = new Edge($node[5], $node[6], 3.58034);
    $edge[6] = new Edge($node[6], $node[7], 0.572283);
    $edge[7] = new Edge($node[7], $node[8], 4.19426);
    $edge[8] = new Edge($node[8], $node[9], 2.80176);
    $edge[9] = new Edge($node[9], $node[10], 2.79058);
    $edge[10] = new Edge($node[10], $node[11], 3.19882);
    $edge[11] = new Edge($node[11], $node[12], 1.65285);
    $edge[12] = new Edge($node[13], $node[14], 2.17668);
    $edge[13] = new Edge($node[14], $node[9], 2.64083);
    $edge[14] = new Edge($node[15], $node[16], 0.605219);
    $edge[15] = new Edge($node[16], $node[17], 1.45588);
    $edge[16] = new Edge($node[17], $node[18], 1.05447);
    $edge[17] = new Edge($node[18], $node[19], 0.526926);
    $edge[18] = new Edge($node[19], $node[20], 0.732601);
    $edge[19] = new Edge($node[20], $node[21], 0.876139);
    $edge[20] = new Edge($node[21], $node[22], 1.66963);
    $edge[21] = new Edge($node[22], $node[5], 1.30923);
    $edge[22] = new Edge($node[23], $node[24], 1.48633);
    $edge[23] = new Edge($node[24], $node[25], 4.33531);
    $edge[24] = new Edge($node[25], $node[26], 3.77856);
    $edge[25] = new Edge($node[26], $node[27], 3.52195);
    $edge[26] = new Edge($node[27], $node[28], 3.67543);
    $edge[27] = new Edge($node[28], $node[29], 3.33865);
    $edge[28] = new Edge($node[29], $node[30], 1.55779);
    $edge[29] = new Edge($node[30], $node[31], 0.648094);
    $edge[30] = new Edge($node[31], $node[32], 2.10148);
    $edge[31] = new Edge($node[32], $node[33], 2.19967);
    $edge[32] = new Edge($node[65], $node[34], 5.3345);
    $edge[33] = new Edge($node[34], $node[35], 2.22762);
    $edge[34] = new Edge($node[35], $node[5], 2.80052);
    $edge[35] = new Edge($node[36], $node[37], 0.298881);
    $edge[36] = new Edge($node[37], $node[38], 1.07746);
    $edge[37] = new Edge($node[38], $node[39], 2.1891);
    $edge[38] = new Edge($node[66], $node[40], 3.01241);
    $edge[39] = new Edge($node[40], $node[41], 1.9449);
    $edge[40] = new Edge($node[41], $node[9], 2.43391);
    $edge[41] = new Edge($node[33], $node[36], 1.63048);
    $edge[42] = new Edge($node[32], $node[36], 1.59071);
    $edge[43] = new Edge($node[42], $node[43], 0.365988);
    $edge[44] = new Edge($node[43], $node[44], 0.592792);
    $edge[45] = new Edge($node[44], $node[45], 0.372825);
    $edge[46] = new Edge($node[45], $node[46], 0.24855);
    $edge[47] = new Edge($node[46], $node[47], 1.64851);
    $edge[48] = new Edge($node[42], $node[39], 3.33057);
    $edge[49] = new Edge($node[36], $node[42], 1.5292);
    $edge[50] = new Edge($node[48], $node[49], 4.32661);
    $edge[51] = new Edge($node[49], $node[50], 3.5611);
    $edge[52] = new Edge($node[50], $node[51], 2.96147);
    $edge[53] = new Edge($node[51], $node[52], 2.70422);
    $edge[54] = new Edge($node[52], $node[53], 1.14519);
    $edge[55] = new Edge($node[53], $node[54], 0.502692);
    $edge[56] = new Edge($node[54], $node[55], 2.81669);
    $edge[57] = new Edge($node[55], $node[42], 3.12674);
    $edge[58] = new Edge($node[56], $node[57], 6.59776);
    $edge[59] = new Edge($node[57], $node[58], 5.07477);
    $edge[60] = new Edge($node[58], $node[59], 5.19097);
    $edge[61] = new Edge($node[59], $node[27], 0.470381);
    $edge[62] = new Edge($node[60], $node[61], 1.76656);
    $edge[63] = new Edge($node[61], $node[62], 2.849);
    $edge[64] = new Edge($node[60], $node[51], 5.24313);
    $edge[65] = new Edge($node[61], $node[27], 2.75019);
    $edge[66] = new Edge($node[63], $node[61], 2.11763);
    $edge[67] = new Edge($node[63], $node[64], 3.60211);
    $edge[68] = new Edge($node[64], $node[32], 4.32102);
    $edge[69] = new Edge($node[33], $node[65], 4.63919);
    $edge[70] = new Edge($node[66], $node[39], 1.81005);
    
    $edge[71] = new Edge($node[1], $node[0], 1.20919);
    $edge[72] = new Edge($node[2], $node[1], 1.56523);
    $edge[73] = new Edge($node[3], $node[2], 4.94177);
    $edge[74] = new Edge($node[4], $node[3], 2.34195);
    $edge[75] = new Edge($node[5], $node[4], 4.56459);
    $edge[76] = new Edge($node[6], $node[5], 3.58034);
    $edge[77] = new Edge($node[7], $node[6], 0.572283);
    $edge[78] = new Edge($node[8], $node[7], 4.19426);
    $edge[79] = new Edge($node[9], $node[8], 2.80176);
    $edge[80] = new Edge($node[10], $node[9], 2.79058);
    $edge[81] = new Edge($node[11], $node[10], 3.19882);
    $edge[82] = new Edge($node[12], $node[11], 1.65285);
    $edge[83] = new Edge($node[14], $node[13], 2.17668);
    $edge[84] = new Edge($node[9], $node[14], 2.64083);
    $edge[85] = new Edge($node[16], $node[15], 0.605219);
    $edge[86] = new Edge($node[17], $node[16], 1.45588);
    $edge[87] = new Edge($node[18], $node[17], 1.05447);
    $edge[88] = new Edge($node[19], $node[18], 0.526926);
    $edge[89] = new Edge($node[20], $node[19], 0.732601);
    $edge[90] = new Edge($node[21], $node[20], 0.876139);
    $edge[91] = new Edge($node[22], $node[21], 1.66963);
    $edge[92] = new Edge($node[5], $node[22], 1.30923);
    $edge[93] = new Edge($node[24], $node[23], 1.48633);
    $edge[94] = new Edge($node[25], $node[24], 4.33531);
    $edge[95] = new Edge($node[26], $node[25], 3.77856);
    $edge[96] = new Edge($node[27], $node[26], 3.52195);
    $edge[97] = new Edge($node[28], $node[27], 3.67543);
    $edge[98] = new Edge($node[29], $node[28], 3.33865);
    $edge[99] = new Edge($node[30], $node[29], 1.55779);
    $edge[100] = new Edge($node[31], $node[30], 0.648094);
    $edge[101] = new Edge($node[32], $node[31], 2.10148);
    $edge[102] = new Edge($node[33], $node[32], 2.19967);
    $edge[103] = new Edge($node[34], $node[65], 5.3345);
    $edge[104] = new Edge($node[35], $node[34], 2.22762);
    $edge[105] = new Edge($node[5], $node[35], 2.80052);
    $edge[106] = new Edge($node[37], $node[36], 0.298881);
    $edge[107] = new Edge($node[38], $node[37], 1.07746);
    $edge[108] = new Edge($node[39], $node[38], 2.1891);
    $edge[109] = new Edge($node[40], $node[66], 3.01241);
    $edge[110] = new Edge($node[41], $node[40], 1.9449);
    $edge[111] = new Edge($node[9], $node[41], 2.43391);
    $edge[112] = new Edge($node[36], $node[33], 1.63048);
    $edge[113] = new Edge($node[36], $node[32], 1.59071);
    $edge[114] = new Edge($node[43], $node[42], 0.365988);
    $edge[115] = new Edge($node[44], $node[43], 0.592792);
    $edge[116] = new Edge($node[45], $node[44], 0.372825);
    $edge[117] = new Edge($node[46], $node[45], 0.24855);
    $edge[118] = new Edge($node[47], $node[46], 1.64851);
    $edge[119] = new Edge($node[39], $node[42], 3.33057);
    $edge[120] = new Edge($node[42], $node[36], 1.5292);
    $edge[121] = new Edge($node[49], $node[48], 4.32661);
    $edge[122] = new Edge($node[50], $node[49], 3.5611);
    $edge[123] = new Edge($node[51], $node[50], 2.96147);
    $edge[124] = new Edge($node[52], $node[51], 2.70422);
    $edge[125] = new Edge($node[53], $node[52], 1.14519);
    $edge[126] = new Edge($node[54], $node[53], 0.502692);
    $edge[127] = new Edge($node[55], $node[54], 2.81669);
    $edge[128] = new Edge($node[42], $node[55], 3.12674);
    $edge[129] = new Edge($node[57], $node[56], 6.59776);
    $edge[130] = new Edge($node[58], $node[57], 5.07477);
    $edge[131] = new Edge($node[59], $node[58], 5.19097);
    $edge[132] = new Edge($node[27], $node[59], 0.470381);
    $edge[133] = new Edge($node[61], $node[60], 1.76656);
    $edge[134] = new Edge($node[62], $node[61], 2.849);
    $edge[135] = new Edge($node[51], $node[60], 5.24313);
    $edge[136] = new Edge($node[27], $node[61], 2.75019);
    $edge[137] = new Edge($node[61], $node[63], 2.11763);
    $edge[138] = new Edge($node[64], $node[63], 3.60211);
    $edge[139] = new Edge($node[32], $node[64], 4.32102);
    $edge[140] = new Edge($node[65], $node[33], 4.63919);
    $edge[141] = new Edge($node[39], $node[66], 1.81005);
    
    for($i = 0;$i < 71;$i++)
    {
        $edge[$i+71] = new Edge($edge[$i].)
    }
    
$engine = new Engine();
/*
$car = new Car($node4);
$car->setPath(array($node2,$node3,$node4));
$node1->putCar($car);
$car = new Car($node4);
$car->setPath(array($node2,$node3,$node4));
$node1->putCar($car);
$car = new Car($node4);
$car->setPath(array($node3,$node4));
$node2->putCar($car);
$car = new Car($node4);
$car->setPath(array($node4));
$node3->putCar($car);*/
    
    for($i = 0;$i < 67;$i++)
    {
        $engine->addNode($node[$i]);
    }
    for($i = 0;$i < 142;$i++)
    {
        $engine->addEdge($edge[$i]);
    }

    for($i = 0;$i < 71;$i++)
    {
        if($i < 67)
            echo 'node'.$i.' is '.$node[$i]->id."\n";
        echo 'edge'.$i.' is '.$edge[$i]->id."\n";
    }

$engine->start();


echo 'done';

?>