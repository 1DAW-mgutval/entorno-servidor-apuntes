<?php

/////////////////////////////////////// SOLUCIONES DE BAJO NIVEL

// $fp = fopen("src/coches.csv", "r");
// $coches = [];

// if ($nombre_campos = fgetcsv($fp, 1000, ",")) {
//     while ($data = fgetcsv($fp, 1000, ",")) {
//         $coches[$data[3]] = array_combine($nombre_campos, $data);
//     }

//     foreach ($coches as $coche) {
//         if ($coche['color'] == 'blanco') {
//         echo "<pre>";
//         print_r($coche);
//         echo "<pre>";
//         }
//     }
// }

// fclose($fp);



////////////////////////////////// SOLUCIONES DE ALTO NIVEL

include('src/functions.php');

$coches = CSVtoArray('data_source/coches.csv');

dump(print_r($coches, true));
