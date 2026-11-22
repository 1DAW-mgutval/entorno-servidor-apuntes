<?php
function dump($dump)
{
    echo '<pre>';
    var_dump($dump);
    echo '</pre>';
}

function generarPalabra()
{
    $palabrasValidas = [
        'JOSEDA',
        'HUGO',
        'ZELDA',
        'JASON',
        'LINUX'
    ];
    return $palabrasValidas[random_int(0, count($palabrasValidas) - 1)];
}

function validarLetra($letra)
{
    if (in_array(strtoupper($letra), ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'Ñ', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z']) && strlen($letra)) {
        return true;
    }
    return false;
}

function validarPalabra($palabra)
{
    dump(explode(' ', $_SESSION['palabra']));
    foreach ($palabra as $posicion => $letraActual) {
        if (!validarLetra($letraActual)) {
            $_SESSION['flash'] = 'Introduzca una palabra válida';
            if ($posicion > 0) {
                unset($_SESSION['intentosAnteriores'][$_SESSION['numIntentos']]);
            }
            return null;
        } else {
            if (substr($_SESSION['palabra'], $posicion, 1) === strtoupper($letraActual)) {
                $_SESSION['intentosAnteriores'][$_SESSION['numIntentos']][$posicion] = [
                    'letra' => $letraActual,
                    'valid' => 1
                ];
            } elseif (in_array(strtoupper($letraActual), str_split($_SESSION['palabra']))) {
                $_SESSION['intentosAnteriores'][$_SESSION['numIntentos']][$posicion] = [
                    'letra' => $letraActual,
                    'valid' => 0
                ];
            } else {
                $_SESSION['intentosAnteriores'][$_SESSION['numIntentos']][$posicion] = [
                    'letra' => $letraActual,
                    'valid' => -1
                ];
            }
        }
    }
    return true;
}
