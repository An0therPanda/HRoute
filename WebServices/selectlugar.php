<?php
    
    /**
     * Funcion para obtener los todos los destinos.
     *
     * Esta función recibe la id de lugar, esta id será la que está seleccionada luego en el dropdown. Se hace la
     * consulta donde se buscan todos los datos de la tabla lugares. Luego de comprobar errores se empiezan a crear
     * las opciones dentro del dropdown. En el caso de que el id del lugar recibido se igual al id del resultado
     * se crea la opción como seleccionada y en otro caso solamente se agrega como opción del dropdown.
     * 
     * @param  mixed $lugar_id
     * @return void
     */

    function getDestinoOptions($lugar_id) {
        require 'database.php';
        $consulta = "select * from LUGARES";
        $resultado = mysqli_prepare($conexion, $consulta);

        if(!$resultado) {
            echo "Error: ".mysqli_error($conexion);
        }
        $ok = mysqli_stmt_execute($resultado);

        if(!$ok) {
            echo "Error";
        } else {
            $ok = mysqli_stmt_bind_result($resultado, $r_id, $r_lugar);
            while ($fila = mysqli_stmt_fetch($resultado)) {
                if ($r_id == $lugar_id) {
                    echo "<option value='$r_id' selected>$r_lugar</option>";
                } else {
                    echo "<option value='$r_id'>$r_lugar</option>";
                }
            }
        }
    }
        
    /**
     * Función para obtener el origen del piso. 
     *
     * Esta función recibe el parametro del piso del usuario. Con este parametro lo que haremos es hacer la consulta 
     * necesaria para obtener todos los datos de la tabla lugares donde la ID se la misma del piso del usuario.
     * Si nuestra consulta se realiza con exito se ingresa la opción dentro del dropdown ubicado en la intefaz que
     * requiera de esta función.
     * 
     * @param  mixed $piso_usuario
     * @return void
     */

    function getOrigenOptions($piso_usuario) {
        require 'database.php';
        $consulta = "select * from LUGARES where ".$piso_usuario." = ID";
        $resultado = mysqli_prepare($conexion, $consulta);

        if(!$resultado) {
            echo "Error: ".mysqli_error($conexion);
        }
        $ok = mysqli_stmt_execute($resultado);

        if(!$ok) {
            echo "Error";
        } else {
            $ok = mysqli_stmt_bind_result($resultado, $r_id, $r_lugar);
            while($fila = mysqli_stmt_fetch($resultado)) {
                echo "<option value='$r_id' selected>$r_lugar</option>";
            }
        }
    }
?>