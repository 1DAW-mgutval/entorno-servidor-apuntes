<?php

// Función debug
function dump($dump)
{
    echo "<pre>" . $dump . "</pre>";
}

// Pasar CSV a Array
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

// Mirar si el índice del array que se quiere es el correcto
function indiceCorrecto(array $array, String $indice)
{
    foreach ($array as $actual) {
        if ($actual === $indice) {
            return true;
        }
    }
    return false;
}

// Pasar CSV a Array con el índice deseado
function CSVtoArrayConIndice(String $rutaCSV, String $indice)
{
    $archivo = file_get_contents($rutaCSV);
    $array = array_map('trim', explode("\n", $archivo));
    $nombre_campos = explode(",", array_shift($array));
    if (indiceCorrecto($nombre_campos, $indice)) {
        $clave = 0;
        $encontrado = false;
        foreach ($nombre_campos as $actual) {
            if (!$encontrado) {
                if ($indice === $actual) {
                    $encontrado = true;
                } else {
                    $clave++;
                }
            }
        }
        $nuevos = [];

        foreach ($array as $linea) {
            $actual = explode(',', $linea);
            $nuevos[$actual[$clave]] = array_combine($nombre_campos, $actual);
        }

        return $nuevos;
    } else {
        dump('[ÍNDICE INCORRECTO]');
    }
}
