<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="estilo/estilo.css" type="text/css">
</head>
<body>
    <?php
        $id = $_POST['id'];
        $estado = $_POST['estado'];
        $contra = $_POST['contrasena'];
        $nomUsuario = $_POST['nomUsuario'];
        $nomCamillero = $_POST['nomCamillero'];

        require 'database.php';

        $consulta = "update USUARIOS set  USUARIO = ?, CONTRASENA = ?, NOMBRE = ?, CONECTADO = ? where ID = ?";

        $resultado = mysqli_prepare($conexion, $consulta);

        //Acceder a los registros

        if(!$resultado){
            echo "Error al modificar: ".mysqli_error($conexion);
        }else{
            header('location: ../HRoute/admin/activos.php');
        }

        $ok = mysqli_stmt_bind_param($resultado, "sssbi", $nomUsuario, $contra, $nomCamillero, $estado, $id);
        $ok = mysqli_stmt_execute($resultado);

        if(!$ok){
            echo "Error";
        }else{
            echo "OK";
        }
        mysqli_stmt_close($resultado);

    ?>
</body>
</html>