<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="estilo/estilo.css" type="text/css">
</head>
<body>
    <?php

        $id = $_GET['id'];

        require 'database.php';

        $consulta = "delete from usuarios where ID = ?";

        $resultado = mysqli_prepare($conexion, $consulta);

        if(!$resultado){
            echo "Error al eliminar";
        }else{
            header('location: ../HRoute/admin/historial.php');
        }

        $ok = mysqli_stmt_bind_param($resultado, "i", $id);
        $ok = mysqli_stmt_execute($resultado);

        if(!$ok){
            echo "Error en la consulta";
        }else{
            echo "OK";
        }
        mysqli_stmt_close($resultado);
    ?>
</body>
</html>