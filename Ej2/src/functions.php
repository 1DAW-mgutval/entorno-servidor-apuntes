<?php

function CSVtoArray(String $rutaCSV)
{
    $archivo = file_get_contents($rutaCSV);
    $array = array_map('trim', explode("\n", $archivo));
    $nombre_campos = explode(",", array_shift($array));
    $nuevos = [];

    foreach ($array as $linea) {
        $actual = explode(',', $linea);
        $nuevos[$actual[count($actual) - 1]] = array_combine($nombre_campos, $actual);
    }

    return $nuevos;
}

function dump($dump)
{
    echo "<pre>" . $dump . "</pre>";
}