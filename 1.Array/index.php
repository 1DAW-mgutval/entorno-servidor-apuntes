<?php
$coches = array(
    '2876CFF' => array(
        'marca' => 'Citroen',
        'modelo' => 'C4',
        'color' => 'gris'
    ),
    '8376HYH' => array(
        'marca' => 'Renault',
        'modelo' => 'Ranchera',
        'color' => 'rojo'
    ),
    '1234BBB' => array(
        'marca' => 'Seat',
        'modelo' => 'Ibiza',
        'color' => 'blanco'
    ),
    '5678CZX' => array(
        'marca' => 'Ford',
        'modelo' => 'Focus',
        'color' => 'azul'
    ),
    '9012DDF' => array(
        'marca' => 'Volkswagen',
        'modelo' => 'Golf',
        'color' => 'negro'
    ),
    '3456FGH' => array(
        'marca' => 'Toyota',
        'modelo' => 'Corolla',
        'color' => 'plata'
    ),
    '7890JKL' => array(
        'marca' => 'Peugeot',
        'modelo' => '208',
        'color' => 'amarillo'
    ),
    '2345MNP' => array(
        'marca' => 'Audi',
        'modelo' => 'A3',
        'color' => 'rojo'
    ),
    '6789RST' => array(
        'marca' => 'BMW',
        'modelo' => 'Serie 1',
        'color' => 'gris'
    ),
    '1122VWX' => array(
        'marca' => 'Kia',
        'modelo' => 'Sportage',
        'color' => 'blanco'
    )
);

$coches2 = [];
foreach ($coches as $coche) {
    $coches2[$coche['matricula']] = $coche;
}

// for($i = 0; $i < count($coches); $i++) {
//     if($coches[$i]['color'] == 'blanco') {
//         echo "<pre>";
//         print_r($coches[$i]);
//         echo "<pre>";
//     }
// }

// array_shift()
// array_pop()
// array_values()
// array_walk()
// in_array()
// reset()
// array_column()
// array_combine()
// array_filter()
// array_is()
// array_map()
