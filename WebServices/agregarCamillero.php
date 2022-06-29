<?php

if(array_key_exists('btnGuardar', $_POST)) {
    agregarCamillero();
}

/**
 * agregarCamillero
 *
 * @return void
 */

function agregarCamillero()
{
    $nombre_usuario = $_POST['nomUsuario'];
    $nombre_camillero = $_POST['nomCamillero'];
    $tipo = 2;
    $conectado = 0;

    require 'database.php';

    $consulta = "insert into usuarios (USUARIO, CONTRASENA, NOMBRE, TIPO_USUARIO, CONECTADO) values ('" . $nombre_usuario . "','" . $nombre_usuario . "','" . $nombre_camillero . "','" . $tipo . "','" . $conectado . "')";

    $resultado = mysqli_query($conexion, $consulta);

    //Acceder a los registros

    if (!$resultado) {
        echo "Error al insertar: " . mysqli_error($conexion);
    } else {
        header('location: ../admin/activos.php');
    }

    mysqli_close($conexion);
}
?>