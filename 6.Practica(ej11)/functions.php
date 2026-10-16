<?php

function dump($dump)
{
    echo "<pre>";
    var_dump($dump);
    echo "</pre>";
}

// Coge los datos del csv
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

// Función para crear la tabla
function crearTabla($resultadoCSV)
{
    $output = '';
    $output .= '<tr>';
    // Genero el head de cada columna de la tabla
    $cabecera = array_shift($resultadoCSV);
    foreach ($cabecera as $key => $value) {
        $output .= '<th>';
        $output .= htmlspecialchars($value);
        $output .= '</th>';
    }
    $output .= '</tr>';

    // Si al quitar la cabezera, que siempre está, el array continua vacío, da error.
    if ($resultadoCSV == null) {
        return null;
    }

    // Genero cada fila de la tabla
    foreach ($resultadoCSV as $key => $reserva) {
        $output .= '<tr>';
        foreach ($reserva as $clave => $valor) {
            $output .= '<td>';
            $output .= htmlspecialchars($valor);
            $output .= '</td>';
        }
        $output .= '</tr>';
    }
    return $output;
}

// Filtra en las reservas ($reservas) lo que le digas en $buscarPor, por ejemplo, buscar por pista.
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

// Esta función pinta el resultado de lo que necesitas. Si se filtra o no, si al filtrar hay resultado o no...
function pintarResultado()
{
    $reservas = getReservas();
    $filtradoPorPistas = null;
    $filtradoPorFecha = null;
    $ambosFiltros = null;
    if (!empty($_GET)) {
        $filtradoPorPistas = filtrarPor($reservas, 'pista');
        $filtradoPorFecha = filtrarPor($reservas, 'fecha');
    }
    if (!empty($filtradoPorFecha) && !empty($filtradoPorPistas)) {
        foreach ($filtradoPorFecha as $key => $value) {
            foreach ($filtradoPorPistas as $clave => $valor) {
                if ($value === $valor) {
                    $ambosFiltros[] = $valor;
                }
            }
        }
    }

    $tablaReservas = crearTabla($reservas);
    if (isset($_GET) && !empty($_GET)) {
        $peticion = array_keys($_GET);
        if ($ambosFiltros != null) {
            if (count($ambosFiltros) > 1) {
                echo crearTabla($ambosFiltros);
            } else {
                echo '<h2>NO HAY RESERVAS</h2>';
            }
        } elseif ($peticion[1] == 'fecha' && count($filtradoPorFecha) > 1) {
            echo crearTabla($filtradoPorFecha);
        } elseif ($peticion[0] == 'pista' && count($filtradoPorPistas) > 1) {
            echo crearTabla($filtradoPorPistas);
        } else {
            echo '<h2>NO HAY RESERVAS</h2>';
        }
    } else {
        if ($tablaReservas !== null) {
            echo crearTabla($reservas);
        } else {
            echo '<h2>NO HAY RESERVAS</h2>';
        }
    }
}
