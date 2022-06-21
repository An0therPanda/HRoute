<?php
    session_start();
    require 'database.php';
    $consulta = "update USUARIOS set CONECTADO = 0 where ID = ".$_SESSION['id']."";
    $resultado = mysqli_prepare($conexion, $consulta);
    $ok = mysqli_stmt_execute($resultado);
    mysqli_stmt_close($resultado);

    session_destroy();
     
    if (isset($_COOKIE["usuario"]) AND isset($_COOKIE["contra"])){
        setcookie("usuario", '', time() - (3600));
        setcookie("contra", '', time() - (3600));
    }
    
 
    header('location:../Proyecto Desarrollo Web/index.php');
 
?>