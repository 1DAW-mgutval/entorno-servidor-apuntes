<?php
session_start();

include('src/functions.php');

if (!isset($_SESSION['id'])) {
    header('Location: ./login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['empezar'])) {
    $_SESSION['cuestionario'] = [
        'preguntas' => obtenerPreguntasAleatorias(),
        'acertadas' => [],
    ];
    $_SESSION['cuestionario']['ultimaPregunta'] = 0;
    header('Location: ./cuestionario.php');
}


include('templates/bienvenida.tpl.php');
