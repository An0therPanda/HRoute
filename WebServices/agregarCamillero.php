<?php

if(array_key_exists('btnGuardar', $_POST)) {
    agregarCamillero();
}

/**
 * Función encargada de agregar camilleros a la base de datos.
 * 
 * A través del formulario que se rellena en las interfaces de usuario obtenemos los datos del camillero.
 * Luego se hará la conexión a la base de datos donde ingresaremos la consulta "insert" nesaria para agregar los
 * datos a la tabla usuarios. Luego de crearse la consulta intenta agregar los datos, en el caso de no poder lograr
 * ingresarlos se manda un mensaje de error y en caso de que si se puede se redirige a la tabla de los camilleros.
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