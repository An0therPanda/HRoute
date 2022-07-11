<?php
    if(array_key_exists('btnModificar', $_POST)){
        editarTraslado();
    }    
    /**
     * Función encargada de editar los traslados en la base de datos.
     * 
     * A través del formulario que se encuentran en la interfaz de modificarTraslado del admin se obtienen los nuevos
     * datos del traslado. Luego se reciben a través de POST los campos necesarios para hacer la consulta en la base
     * de datos luego de que esta se conecta. Si la consulta se ejecuta correctamente se redirige a la intefaz de admin
     * donde se encuentra una tabla con los traslados activos.
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
            header('location: ../admin/traslados.php');
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