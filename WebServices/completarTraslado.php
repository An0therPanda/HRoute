<?php
    
    $id = $_GET['id'];

    require 'database.php';

    $consulta = "update TRASLADOS set REALIZADA = 1 where ID = ?";

    $resultado = mysqli_prepare($conexion, $consulta);

    //Acceder a los registros

    if(!$resultado){
        echo "Error al modificar: ".mysqli_error($conexion);
    }else{
        header('location: ../HRoute/asistente/historialtraslados.php');
    }

    $ok = mysqli_stmt_bind_param($resultado, "i", $id);
    $ok = mysqli_stmt_execute($resultado);

    if(!$ok){
        echo "Error";
    }else{
        echo "OK";
    }
    mysqli_stmt_close($resultado);

?>