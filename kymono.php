<?php

/**
 * @param $plages
 * @param string $callBack
 *
 * @return array
 */
function triFusion($plages, $callBack = 'triNaturel')
{
    $length = count($plages);
    if ($length == 1) {
        return $plages;
    } else {
        //découper le tableau en deux partie
        $demi = intval($length / 2);
        $plageA = array_slice($plages, 0, $demi);
        $plageB = array_slice($plages, $demi);
        return fusion(triFusion($plageA, $callBack), triFusion($plageB, $callBack), $callBack);
    }

}

/**
 * @param $plageA
 * @param $plageB
 * @param string $callBack
 *
 * @return array
 */
function fusion($plageA, $plageB, $callBack = 'triNaturel')
{
    if (empty($plageA)) {
        return $plageB;
    }
    if (empty($plageB)) {
        return $plageA;
    }
    $plageA0 = $plageA[0];
    $plageB0 = $plageB[0];

    $compare0 = $callBack($plageA0[0], $plageB0[0]);
    $compare1 = $callBack($plageA0[1], $plageB0[1]);

    if ($compare0 == 0 && $compare1 == 0) {
        $compare = 0;
    } elseif ($compare0 > 0 || ($compare0 == 0 && $compare1 > 0)) {
        $compare = 1;
    } else {
        $compare = -1;
    }

    if ($compare <= 0) {
        $plageARest = (count($plageA) == 1) ? [] : array_slice($plageA, 1);
        return array_merge([$plageA0], fusion($plageARest, $plageB));
    } else {
        $plageBRest = (count($plageB) == 1) ? [] : array_slice($plageB, 1);
        return array_merge([$plageB0], fusion($plageA, $plageBRest));
    }
}

/**
 * @param $a
 * @param $b
 *
 * @return int
 */
function triNaturel($a, $b)
{
    if ($a == $b) {
        return 0;
    } elseif ($a > $b) {
        return 1;
    } else {
        return -1;
    }
}

/**
 * Fonction pour trouver les plages contigues
 *
 * @param $plages
 * @param null $callable
 *
 * @return array
 */
function contigue($plages, $callable = 'triNaturel')
{
    $triPlages = triFusion($plages, $callable);

    $resultat = [];

    $contigue = $triPlages[0];
    for ($i = 1; $i < count($triPlages); $i++) {
        $p = $triPlages[$i];


        $compareGauche = $callable($contigue[0], $p[0]);
        $compareDroite = $callable($p[0], $contigue[1]);

        if ($compareGauche <= 0 && $compareDroite <= 0) {
            $gauche = ($callable($contigue[0], $p[0]) <= 0) ? $contigue[0] : $p[0];
            $droite = ($callable($contigue[1], $p[1]) > 0) ? $contigue[1] : $p[1];
            $contigue = [$gauche, $droite];
        } else {
            $resultat[] = $contigue;
            $contigue = $p;
        }
    }
    $resultat[] = $contigue;
    return $resultat;

}

// pour les entiers
$plagesInt = [
    [3, 7],
    [2, 5],
    [3, 4],
    [15, 17],
    [9, 10],
    [11, 13],
];

var_dump(contigue($plagesInt));

// pour les IP
$plagesIp = [
    ["127.0.0.10", "127.0.0.21"],
    ["127.0.0.9", "127.0.0.15"]
];

// callback pour comparer les ips
$compareIp = function ($ip1, $ip2) {
    $ip1Array = explode('.', $ip1);
    $ip2Array = explode('.', $ip2);

    $ip1IntArray = array_map('intval', $ip1Array);
    $ip2IntArray = array_map('intval', $ip2Array);

    //on suppose les ips sont correts (ipv4)
    for ($i = 0; $i < 4; $i++) {
        if ($ip1IntArray[$i] > $ip2IntArray[$i]) {
            return 1;
        } elseif ($ip1IntArray[$i] < $ip2IntArray[$i]) {
            return -1;
        }
    }
    return 0;
};

var_dump(contigue($plagesIp, $compareIp));

