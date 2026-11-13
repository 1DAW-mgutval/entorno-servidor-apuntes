<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ./login.php');
}

// dump($_SESSION);

include('src/functions.php');
include('templates/bienvenida.tpl.php');
