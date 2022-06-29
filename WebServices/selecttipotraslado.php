<?php
    
    /**
     * Función para obtener los tipos de traslados.
     *
     * Esta función recibe la id del tipo de traslado, esta id será la que estará seleccionada luego en el dropdown. 
     * Se hace la consulta donde se buscan todos los datos de la tabla tipo_traslados. Luego de comprobar errores se 
     * empiezan a crear las opciones dentro del dropdown. En el caso de que el id del tipo de traslasdo recibido 
     * se igual al id del resultado se crea la opción como seleccionada y en otro caso solamente se agrega como opción
     * del dropdown.
     * 
     * @param  mixed $tipotraslado_id
     * @return void
     */

    function getTipoTrasladosOptions($tipotraslado_id){
        require 'database.php';
        $consulta = "select * from TIPO_TRASLADOS";
        $resultado = mysqli_prepare($conexion, $consulta);

        if(!$resultado){
            echo "Error: ".mysqli_error($conexion);
        }
        $ok = mysqli_stmt_execute($resultado);

        if(!$ok){
            echo "Error";
        }else{
            $ok = mysqli_stmt_bind_result($resultado, $r_id, $r_tipotraslados);
            while($fila = mysqli_stmt_fetch($resultado)){
                if ($r_id == $tipotraslado_id){
                    echo "<option value='$r_id' selected>$r_tipotraslados</option>";
                } else{
                    echo "<option value=".$r_id.">".$r_tipotraslados."</option>";
                }            
            }
        }
    }    
?>