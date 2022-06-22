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
        $origen = $_POST['oriTraslado'];
        $destino = $_POST['desTraslado'];
        $tipo_traslado = $_POST['tipoTraslado'];
        $nombre_trabajador = $_POST['trabajadorTraslado'];
        $nombre_personal = $_POST['nomPersonal'];
        $nombre_paciente = $_POST['nomPaciente'];
        $realizada = $_POST['realizada'];

        require 'database.php';

        $consulta = "update TRASLADOS set ORIGEN = ?, DESTINO = ?, TIPO_TRASLADO = ?, NOMBRE_TRABAJADOR = ?, NOMBRE_PERSONAL = ?, NOMBRE_PACIENTE = ?, REALIZADA = ? where ID = ?";

        $resultado = mysqli_prepare($conexion, $consulta);

        //Acceder a los registros

        if(!$resultado){
            echo "Error al modificar: ".mysqli_error($conexion);
        }else{
            header('location: ../HRoute/enfer/traslados.php');
        }

        $ok = mysqli_stmt_bind_param($resultado, "iiiissii", $origen, $destino, $tipo_traslado , $nombre_trabajador, $nombre_personal, $nombre_paciente, $realizada, $id);
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