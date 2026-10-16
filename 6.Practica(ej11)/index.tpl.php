<?php

/** @var array $reservas **/ ?>
<?php /** @var array $filtradoPorPistas **/ ?>
<?php /** @var array $filtradoPorFecha **/ ?>
<?php /** @var array $ambosFiltros **/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="https://cdn.simplecss.org/simple.min.css">
</head>

<body>
    <table>
        <?php
        function imprimirTabla($resultadoCSV)
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

        $tablaReservas = imprimirTabla($reservas);
        if (isset($_GET) && !empty($_GET)) {
            $peticion = array_keys($_GET);
            if ($ambosFiltros != null) {
                if (count($ambosFiltros) > 1) {
                    echo imprimirTabla($ambosFiltros);
                } else {
                    echo '<h2>NO HAY RESERVAS</h2>';
                }
            } elseif ($peticion[1] == 'fecha' && count($filtradoPorFecha) > 1) {
                echo imprimirTabla($filtradoPorFecha);
            } elseif ($peticion[0] == 'pista' && count($filtradoPorPistas) > 1) {
                echo imprimirTabla($filtradoPorPistas);
            } else {
                echo '<h2>NO HAY RESERVAS</h2>';
            }
        } else {
            if ($tablaReservas !== null) {
                echo imprimirTabla($reservas);
            } else {
                echo '<h2>NO HAY RESERVAS</h2>';
            }
        }

        ?>
    </table>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
        <label for="pista">Pista:</label>
        <input type="text" name="pista" placeholder="Nombre de la pista...">
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha">
        <button type="submit">Enviar</button>
    </form>
    
</body>

</html>