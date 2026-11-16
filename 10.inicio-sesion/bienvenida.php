<?php
session_start();

include('src/functions.php');

if (!isset($_SESSION['id'])) {
    header('Location: ./login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['empezar'])) {
    $_SESSION['cuestionario'] = [
        'preguntas' => obtenerPreguntasAleatorias(),
        'respuestas' => [],
    ];
    $_SESSION['cuestionario']['ultimaPregunta'] = 0;
    header('Location: ./cuestionario.php');
    exit();
}

$historial = historialUsuario();
if (isset($historial) && !empty($historial)) {
    $headers = array_keys($historial[0]);
}

include('templates/bienvenida.tpl.php');
