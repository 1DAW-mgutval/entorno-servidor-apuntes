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


function getReservas()
{
    $res = null;
    $f = fopen("datos/reservas.csv", "r");
    while (($linea = fgetcsv($f)) !== false) {
        $res[] = $linea;
    }
    fclose($f);
    return $res;
}

function filtrarPor($reservas, $buscarPor)
{
    $buscador = filter_input(INPUT_GET, $buscarPor);
    if ($buscador === '') {
        return [];
    }
    if ($buscarPor === 'fecha') {
        $buscador = substr($buscador, -2) . '-' . substr($buscador, -5, 2) . '-' . substr($buscador, -10, 4);
    }
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

$reservas = getReservas();
if (!empty($_GET)) {
    $filtradoPorPistas = filtrarPor($reservas, 'pista');
    $filtradoPorFecha = filtrarPor($reservas, 'fecha');
}
$ambosFiltros = null;
if (!empty($filtradoPorFecha) && !empty($filtradoPorPistas)) {
    foreach ($filtradoPorFecha as $key => $value) {
        foreach ($filtradoPorPistas as $clave => $valor) {
            if ($value === $valor) {
                $ambosFiltros[] = $valor;
            }
        }
    }
}



include('index.tpl.php');
