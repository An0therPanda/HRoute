<?php

    $origen = $_POST['oriTraslado'];
    $destino = $_POST['desTraslado'];
    $tipo_traslado = $_POST['tipoTraslado'];
    $nombre_trabajador = $_POST['trabajadorTraslado'];
    $nombre_personal = $_POST['nomPersonal'];
    $nombre_paciente = $_POST['nomPaciente'];

    require 'database.php';

    $consulta = "insert into traslados (ORIGEN, DESTINO, TIPO_TRASLADO, NOMBRE_TRABAJADOR, NOMBRE_PERSONAL, NOMBRE_PACIENTE) values ('".$origen."','".$destino."','".$tipo_traslado."','".$nombre_trabajador."','".$nombre_personal."','".$nombre_paciente."')"; 

    $resultado = mysqli_query($conexion, $consulta);

    //Acceder a los registros

    if(!$resultado){
        echo "Error al insertar: ".mysqli_error($conexion);
    }else{
        header('location: ../Proyecto Desarrollo Web/admin/agregar.php');
    }

    mysqli_close($conexion);

?>