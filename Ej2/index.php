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
$archivo = file_get_contents('src/coches.csv');
$coches = explode("\n",$archivo);
$nombre_campos = explode(",",array_shift($coches));
$nuevos = [];

foreach ($coches as $coche) {
    $actual = explode(',',$coche);
    $nuevos[$actual[3]] = array_combine($nombre_campos, $actual);
}

echo "<pre>";
echo print_r($nuevos);
echo "<pre>";