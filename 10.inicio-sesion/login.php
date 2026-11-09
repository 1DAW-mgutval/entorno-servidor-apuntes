<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    # code...
}


include('src/functions.php');
include('templates/login.tpl.php');

