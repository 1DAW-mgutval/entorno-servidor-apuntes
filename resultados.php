<?php
session_start();

include('src/functions.php');

$resultado = null;

if (!isset($_SESSION['id'])) {
    header('Location: ./login.php');
} elseif (!isset($_SESSION['cuestionario']) || count($_SESSION['cuestionario']['respuestas']) < 5) {
    header('Location: ./bienvenida.php');
} elseif(!isset($resultado)) {
    $resultado = 0;
    foreach ($_SESSION['cuestionario']['respuestas'] as $pregunta => $respuesta) {
        if ((respuestaCorrecta($_SESSION['cuestionario']['preguntas'][$pregunta], $respuesta)) > 0) {
            $resultado++;
        }
    }
}

include('templates/resultados.tpl.php');