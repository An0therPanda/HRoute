<?php
    
    /**
     * Función para obtenener los camilleros activos.
     *
     * Esta función recibe la id del trabajor, esta id será la que estará seleccionada luego en el dropdown. Se hace la
     * consulta donde se buscan todos los datos de la tabla usuarios donde el tipo de usuarios sea camillero y donde
     * esté conectado. Luego de comprobar errores se empiezan a crear las opciones dentro del dropdown. En el caso 
     * de que el id del trabajador recibido se igual al id del resultado se crea la opción como seleccionada y en otro
     * caso solamente se agrega la opción del del dropdown.
     * 
     * @param  mixed $trabajador_id
     * @return void
     */
    function getTrabajadorOptions($trabajador_id){
        require 'database.php';
        $consulta = "select * from usuarios where CONECTADO = 1 AND TIPO_USUARIO = 2";
        $resultado = mysqli_prepare($conexion, $consulta);

        if(!$resultado){
            echo "Error: ".mysqli_error($conexion);
        }
        $ok = mysqli_stmt_execute($resultado);

        if(!$ok){
            echo "Error";
        }else{
            $ok = mysqli_stmt_bind_result($resultado, $r_id, $r_usuario, $r_passw, $r_nombre, $r_tipousuario, $r_piso, $r_conectado);
            while($fila = mysqli_stmt_fetch($resultado)){
                if ($r_id == $trabajador_id){
                    echo "<option value='$r_id' selected>$r_nombre</option>";
                } else {
                    echo "<option value=".$r_id.">".$r_nombre."</option>";
                }            
            }
        }
    }    
?>