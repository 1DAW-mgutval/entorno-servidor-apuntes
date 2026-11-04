<?php
include('src/functions.php');
include('templates/index.tpl.php');

dump(obtenerLibro(conectarBaseDeDatos(), 10));
