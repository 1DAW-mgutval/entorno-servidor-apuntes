<?php

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['id'])) {
    header('Location: ./bienvenida.php');
}

include('src/functions.php');
include('templates/registro.tpl.php');