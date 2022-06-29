<?php
    if(array_key_exists('btnEliminar', $_POST)) {
        eliminarTraslado();
    }    
    /**
     * eliminarTraslado
     *
     * @return void
     */
    function eliminarTraslado(){
        $id = $_POST['id'];

        require 'database.php';

        $consulta = "delete from TRASLADOS where ID = ?";

        $resultado = mysqli_prepare($conexion, $consulta);

        if(!$resultado){
            echo "Error al eliminar";
        }else{
            header('location: ../admin/traslados.php');
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