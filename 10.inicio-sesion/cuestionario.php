<?php
session_start();

include('src/functions.php');

if (!isset($_SESSION['id'])) {
    header('Location: ./login.php');
}

if (!isset($_SESSION['cuestionario'])) {
    header('Location: ./bienvenida.php');
}

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
// }

$idPregunta = $_SESSION['cuestionario']['preguntas'][$_SESSION['cuestionario']['ultimaPregunta']];
$preguntaActual = obtenerPregunta($idPregunta);

include('templates/cuestionario.tpl.php');
