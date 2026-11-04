<?php
include('src/functions.php');
include('templates/index.tpl.php');

dump(contarDisponibles(conectarBaseDeDatos()));
