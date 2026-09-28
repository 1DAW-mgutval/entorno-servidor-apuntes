<?php
include('src/functions.php');
// --------------------------------------------------------------------------- Trato de html

$outputCoches = arrayToTable(CSVtoArrayConIndice('data_source/coches.csv', 'matrícula'));

// Se "inyecta" el código de templates y se ejecuta.
include('templates/html.tpl.php');
?>