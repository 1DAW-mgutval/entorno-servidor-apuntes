<?php
function dump($dump)
{
    echo "<pre>";
    var_dump($dump);
    echo "</pre>";
}

session_start();

if (!isset($_SESSION['link-x']) && !isset($_SESSION['link-y'])) {
    $_SESSION['link-x'] = 0;
    $_SESSION['link-y'] = 0;
} else {
    if (!empty($_POST)) {
        if ($_POST['arriba'] == 'true') {
            $_SESSION['link-y']--;
        } else if ($_POST['abajo'] == 'true') {
            $_SESSION['link-y'] = $_SESSION['link-y'] + 1;
        } else if ($_POST['izquierda'] == 'true') {
            $_SESSION['link-x'] = $_SESSION['link-x'] - 1;
        } else if ($_POST['derecha'] == 'true') {
            $_SESSION['link-x']++;
        }
    }

    http_response_code(301);
    header("Location: ?link_pos_x=" . $_SESSION['link-x'] . "&link_pos_y=" . $_SESSION['link-y']);
}

dump($_SESSION);
dump($_POST);

$filtro = [
    'options' => [
        'min_range' => 1,
        'max_range' => 31
    ]
];

$_SESSION = [
    'link-x' => filter_input(INPUT_GET, 'link_pos_x', FILTER_VALIDATE_INT, $filtro),
    'link-y' => filter_input(INPUT_GET, 'link_pos_y', FILTER_VALIDATE_INT, $filtro)
];

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


// for ($i = 0; $i < 32; $i++) {
//     $fila = [];
//     for ($j = 0; $j < 32; $j++) {
//         if (prev($fila) === 'water') {
//             $fila[$j] = $tiles2[rand(0, 2)];
//         } else if (prev($fila) === 'grass') {
//             $fila[$j] = $tiles1[rand(0, 2)];
//         } else {
//             $fila[$j] = $tiles1[rand(0, 1)];
//         }
//     }
//     $mapa[$i] = $fila;
// }

$mapa = [];
$f = fopen("tablero.csv", "r");
while (($linea = fgetcsv($f)) !== false) {
    $mapa[] = $linea;
}
fclose($f);

function generarMapa(array $mapaZelda)
{
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
