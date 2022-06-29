<?php
    if(array_key_exists('btnGuardar', $_POST)){
        editarTraslado();
    }    
    /**
     * Función encargada de editar los datos de los traslados ingresados en la base de datos.
     * 
     * A través del formulario que se rellena en la interfaz de editar traslado se obtienen los datos del mismo.
     * Luego se realiza la conexión a la base de datos, donde se ingresa la consulta "update" utilizando los datos obtenidos desde el formulario. Una vez
     * ingresada la consulta, se realiza la misma a la base de datos. En el caso de no poder realizar la modificación, se manda un mensaje de error.
     * En el caso contrario, se redirige al usuario a la tabla de traslados pendientes.
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
            header('location: ../HRoute/admin/traslados.php');
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