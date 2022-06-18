<?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'hroute';

    $conexion = mysqli_connect($host, $username, $password);

    //Generar validacion de conexion
    if(mysqli_connect_errno()){
        echo "Fallo al conectar";
        exit();
    }

    //Validar existencia de database
    mysqli_select_db($conexion, $database) or die("No se encuentra database");

    //Seleccionar conjunto de caracteres a utilizar.
    mysqli_set_charset($conexion, "utf8");
?>