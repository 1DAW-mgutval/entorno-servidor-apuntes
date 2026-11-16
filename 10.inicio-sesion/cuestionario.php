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
            $_SESSION['cuestionario']['respuestas'][] = $_POST['opcion'];
            if (count($_SESSION['cuestionario']['respuestas']) == 5) {
                header('Location: ./resultados.php');
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
