<?php
function dump($dump)
{
    echo "<pre>" . $dump . "</pre>";
}

// Poner array bien con tamaño
$tiles1 = [
    'grass',
    'water',
    'stone'
];
$tiles2 = [
    'grass',
    'water',
    'bridge'
];

$mapa = [];


for ($i = 0; $i < 32; $i++) {
    $fila = [];
    for ($j = 0; $j < 32; $j++) {
        if (prev($fila) === 'water') {
            $fila[$j] = $tiles2[rand(0, 2)];
        } else if (prev($fila) === 'grass') {
            $fila[$j] = $tiles1[rand(0, 2)];
        } else {
            $fila[$j] = $tiles1[rand(0, 1)];
        }
    }
    $mapa[$i] = $fila;
}

function pintarMapa(array $mapaZelda) {
    $res = '';
    foreach ($mapaZelda as $fila => $columna) {
        foreach ($columna as $numColumna => $tile) {
            switch ($tile) {
                case 'grass':
                    $res .= '<div class="tile grass"></div>';
                    break;
                case 'stone':
                    $res .= '<div class="tile stone"></div>';
                    break;
                case 'water':
                    $res .= '<div class="tile water"></div>';
                    break;
                case 'bridge':
                    $res .= '<div class="tile bridge"></div>';
                    break;
            }
        }
    }
    return $res;
}

include('index.tpl.php');
