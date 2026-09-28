<?php
function dump($dump)
{
    echo "<pre>" . $dump . "</pre>";
}

// Poner array bien con tamaño
$mapa = [32[32]];
$tiles = [
    'grass',
    'stone',
    'water',
    'bridge'
];
foreach ($mapa as $key => $fila) {
    foreach ($fila as $clave => $tileActual) {
        $numTile = rand(0, 3);
        $tileActual = $tiles[$numTile];
    }
}

include('index.tpl.php');
