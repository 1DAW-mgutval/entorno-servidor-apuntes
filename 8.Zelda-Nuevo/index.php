<?php

session_start();

include('src/functions.php');

if (!isset($_SESSION['link-x']) && !isset($_SESSION['link-y'])) {
    $_SESSION['link-x'] = 0;
    $_SESSION['link-y'] = 0;
} else {
    if (!empty($_POST)) {
        if (isset($_POST['direccion'])) {
            validarDireccion($_POST['direccion']);
        }
    }
}

include('templates/index.tpl.php');