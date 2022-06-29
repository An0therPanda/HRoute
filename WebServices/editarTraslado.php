<?php
    if(array_key_exists('btnGuardar', $_POST)){
        editarTraslado();
    }    
    /**
     * editarTraslado
     *
     * @return void
     */
    function editarTraslado(){
        $id = $_POST['id'];
        $origen = $_POST['oriTraslado'];
        $destino = $_POST['desTraslado'];
        $tipo_traslado = $_POST['tipoTraslado'];
        $nivel = $_POST['idPrioridad'];
        if ($_POST['trabajadorTraslado'] == NULL) {
            $nombre_trabajador = 2;
        } else {
            $nombre_trabajador = $_POST['trabajadorTraslado'];
        }
        $nombre_personal = $_POST['nomPersonal'];
        $nombre_paciente = $_POST['nomPaciente'];
        $realizada = $_POST['realizada'];

        require 'database.php';

        $consulta = "update TRASLADOS set ORIGEN = ?, DESTINO = ?, TIPO_TRASLADO = ?, NIVEL_PRIORIDAD = ?, NOMBRE_TRABAJADOR = ?, NOMBRE_PERSONAL = ?, NOMBRE_PACIENTE = ?, REALIZADA = ? where ID = ?";
        $resultado = mysqli_prepare($conexion, $consulta);
        //Acceder a los registros
        if (!$resultado) {
            echo "Error al modificar: " . mysqli_error($conexion);
        } else {
            header('location: ../HRoute/admin/crear.php');
        }

        $ok = mysqli_stmt_bind_param($resultado, "iiiiissii", $origen, $destino, $tipo_traslado, $nivel, $nombre_trabajador, $nombre_personal, $nombre_paciente, $realizada, $id);
        $ok = mysqli_stmt_execute($resultado);

        if (!$ok) {
            echo "Error";
        } else {
            echo "OK";
        }
        mysqli_stmt_close($resultado);
    }
?>