<?php
// contraseña: usuario
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['id'])) {
    header('Location: ./bienvenida.php');
}

include_once('src/functions.php');

$usuario = validarLogin();
$login = intentarLogin($usuario);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $login != false) {
    $_SESSION['id'] = $login['id'];
    $_SESSION['nombre'] = $login['nombre'];
    header('Location: ./bienvenida.php');
}

if (isset($_SESSION['flash'])) {
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
}

include_once('templates/login.tpl.php');
