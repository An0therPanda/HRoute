<?php
    if(array_key_exists('btnEliminar', $_POST)) {
        eliminarCamillero();
    }    
    /**
     * Función encargada de eliminar un camillero existente en la base de datos.
     * 
     * A través de la tabla de camilleros se obtienen los datos del mismo.
     * Luego se realiza la conexión a la base de datos, donde se ingresa la consulta "delete" utilizando los datos obtenidos desde la tabla. Una vez
     * ingresada la consulta, se realiza la misma a la base de datos. En el caso de no poder realizar la eliminación, se manda un mensaje de error.
     * En el caso contrario, se redirige al usuario a la tabla de los camilleros conectados.
     * 
     * @return void
     */
    function eliminarCamillero(){
        $id = $_POST['id'];

        require 'database.php';

        $consulta = "delete from usuarios where ID = ?";

        $resultado = mysqli_prepare($conexion, $consulta);

        if(!$resultado){
            echo "Error al eliminar";
        }else{
            header('location: ../admin/activos.php');
        }

        $ok = mysqli_stmt_bind_param($resultado, "i", $id);
        $ok = mysqli_stmt_execute($resultado);

        if(!$ok){
            echo "Error en la consulta";
        }else{
            echo "OK";
        }
        mysqli_stmt_close($resultado);  
    }    
?>