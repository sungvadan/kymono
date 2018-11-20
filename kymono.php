<?php

function triFusion($plages)
{
    $length = count($plages);
    if($length ==1){
        return $plages;
    } else{
        //découper le tableau en deux partie
        $demi = intval($length / 2);
        $plageA = array_slice($plages, 0, $demi);
        $plageB = array_slice($plages, $demi);
        return fusion(triFusion($plageA), triFusion($plageB));
    }

}

function fusion($plageA, $plageB){
    if (empty($plageA))
        return $plageB;
    if (empty($plageB))
        return $plageA;
    $plageA1 = $plageA[0];
    $plageB1 = $plageB[0];
    if( ($plageA1[0] < $plageB1[0]) || ($plageA1[0] == $plageB1[0] && $plageA1[1] <= $plageB1[1]) ){
        $plageARest = (count($plageA) == 1) ? [] : array_slice($plageA, 1);
        return array_merge([$plageA1], fusion($plageARest, $plageB));
    }
    else{
        $plageBRest = (count($plageB) == 1) ? [] : array_slice($plageB, 1);
        return array_merge([$plageB1], fusion( $plageA, $plageBRest));
    }
}

$plages = [
    [3,7],
    [2,5],
    [3,4],
    [15,17],
    [9,10],
    [11,13],
];

$triPlages = triFusion($plages);

$resultat = [];


$contigue= $triPlages[0];
for ($i = 1; $i < count($triPlages); $i++){
    $p = $triPlages[$i];
    if( $contigue[0] <= $p[0] && $p[0] <= $contigue[1]){
        $contigue = [min($contigue[0] ,$p[0]), max($p[1],$contigue[1])];
    }else{
        $resultat[] = $contigue;
        $contigue = $p;
    }
}
$resultat[] = $contigue;


var_dump($resultat);

