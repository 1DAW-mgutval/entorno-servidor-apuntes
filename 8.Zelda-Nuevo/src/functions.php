<?php
function dump($dump)
{
    echo "<pre>";
    var_dump($dump);
    echo "</pre>";
}

function generarMapa(array $mapaZelda)
{
    $res = '';
    foreach ($mapaZelda as $filas => $columna) {
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

function leerFichero()
{
    $mapa = [];
    $f = fopen("tablero.csv", "r");
    while (($linea = fgetcsv($f)) !== false) {
        $mapa[] = $linea;
    }
    fclose($f);
    return $mapa;
}

function validarDireccion($direccion)
{
    $mapa = leerFichero();
    $validTiles = ['grass', 'bridge'];

    if ($direccion == 'arriba' && $_SESSION['link-y'] - 1 > -1) {
        if (in_array($mapa[$_SESSION['link-y'] - 1][$_SESSION['link-x']], $validTiles)) {
            $_SESSION['link-y']--;
        }
    } else if ($direccion == 'abajo' && $_SESSION['link-y'] + 1 < 32) {
        if (in_array($mapa[$_SESSION['link-y'] + 1][$_SESSION['link-x']], $validTiles)) {
            $_SESSION['link-y']++;
        }
    } else if ($direccion == 'izquierda' && $_SESSION['link-x'] - 1 > -1) {
        if (in_array($mapa[$_SESSION['link-y']][$_SESSION['link-x'] - 1], $validTiles)) {
            $_SESSION['link-x']--;
        }
    } else if ($direccion == 'derecha' && $_SESSION['link-x'] + 1 < 32) {
        if (in_array($mapa[$_SESSION['link-y']][$_SESSION['link-x'] + 1], $validTiles)) {
            $_SESSION['link-x']++;
        }
    }
}
