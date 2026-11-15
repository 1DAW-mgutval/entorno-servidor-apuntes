<?php
session_start();

include('src/functions.php');

if (!isset($_SESSION['id'])) {
    header('Location: ./login.php');
}

if (!isset($_SESSION['cuestionario'])) {
    header('Location: ./bienvenida.php');
}

$idPregunta = $_SESSION['cuestionario']['preguntas'][$_SESSION['cuestionario']['ultimaPregunta']];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['opcion']) && isset($_POST['idPregunta'])) {
    if ($_POST['idPregunta'] == $idPregunta) {
        if (in_array($_POST['opcion'], ['A', 'B', 'C', 'D'])) {
            if (respuestaValida($idPregunta, $_POST['opcion']) > 0) {
                $_SESSION['cuestionario']['acertadas'][] = $_SESSION['cuestionario']['ultimaPregunta'];
            }
            $_SESSION['cuestionario']['ultimaPregunta']++;
            header('Location: ./cuestionario.php');
        }
    } else {
        $_SESSION['flash'] = 'La respuesta a esta pregunta ya se envió';
    }
}

$preguntaActual = obtenerPregunta($idPregunta);

include('templates/cuestionario.tpl.php');
