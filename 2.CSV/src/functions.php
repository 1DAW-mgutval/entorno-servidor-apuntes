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

// Pasar CSV a Array con el índice deseado.
function CSVtoArrayConIndice(String $rutaCSV, String $indice)
{
    $archivo = file_get_contents($rutaCSV);
    $array = array_map('trim', explode("\n", $archivo));
    $nombre_campos = explode(",", array_shift($array));
    // Mira si el índice existe en el nombre de los campos.
    if (isset($nombre_campos, $indice)) {
        $res = [];

        // Primero combinamos los arrays después accedemos al índice.
        foreach ($array as $linea) {
            $actual = explode(',', $linea);
            $actual = array_combine($nombre_campos, $actual);
            $res[$actual[$indice]] = $actual;
        }

        return $res;
    } else {
        dump('[ÍNDICE INCORRECTO]');
    }
}

// 

// 
function arrayToTable($data)
{
    // dump(print_r($data, true));
    $output = '<table>';
    $output .= '<tr>';
    foreach ($data[array_keys($data)[0]] as $key => $value) {
        $output .= '<th>';
        $output .= $key;
        $output .= '</th>';
    }
    $output .= '</tr>';

    foreach ($data as $key => $coche) {
        $output .= '<tr>';
        foreach ($coche as $clave => $value) {
            if ($clave === 'img') {
                $output .= '<td>';
                if ($value !== '') {
                    $output .= '<img src="' . $value . '">';
                } else {
                    $output .= '<img src="src\img\default.png">';
                }
                $output .= '</td>';
            } else {
                $output .= '<td>';
                $output .= $value;
                $output .= '</td>';
            }
        }
        $output .= '</tr>';
    }

    $output .= '</table>';

    return $output;
}
