<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function dump($dump)
{
    echo "<pre>";
    var_dump($dump);
    echo "</pre>";
}


function getReservas() {
    $res = null;
    $f = fopen("datos/reservas.csv", "r");
    while (($linea = fgetcsv($f)) !== false) {
        $res[] = $linea;
    }
    fclose($f);
    return $res;
}

function filtrarPor($reservas, $buscarPor) {
    $buscador = filter_input(INPUT_GET, $buscarPor);
    $res = $reservas[0];
    $indice = 0;
    foreach ($res as $key => $valor) {
        if ($valor == $buscarPor) {
            $indice = $key;
        }
    }
    $res = array_filter($reservas, function ($reservaActual) use ($buscador, $indice) {
        if ($reservaActual[$indice] === $buscador) {
            return true;
        } else {
            return null;
        }
    });
    array_unshift($res, $reservas[0]);
    return $res;
}

// año-mes-dia

$reservas = getReservas();
$filtradoPorPistas = filtrarPor($reservas, 'pista');
$filtradoPorFecha = filtrarPor($reservas, 'fecha');

include('index.tpl.php');