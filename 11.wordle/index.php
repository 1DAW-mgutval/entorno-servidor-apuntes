<?php
include_once(__DIR__ . '/src/functions.php');
session_start();

if (!isset($_SESSION['palabra'])) {
    $_SESSION['palabra'] = generarPalabra();
}

if (!isset($_SESSION['numIntentos'])) {
    $_SESSION['numIntentos'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $intento = filter_input(INPUT_POST, 'letras', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    if (validarPalabra($intento)) {
        $_SESSION['numIntentos']++;
    }
}
dump($_SESSION['palabra']);

include_once(__DIR__ . '/templates/index.tpl.php');
