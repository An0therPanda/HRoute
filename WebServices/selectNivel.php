<?php
    
    /**
     * Función para obtener datos de niveles.
     * 
     * Esta función recibe la id de nivel, esta id será la que estará seleccionada luego en el dropdown. Se hace la
     * consulta donde se buscan todos los datos de la tabla nivel_prioridad. Luego de comprobar errores se empiezan a 
     * crear las opciones dentro del dropdown. En el caso de que el id del nivel recibido se igual al id del resultado
     * se crea la opción como seleccionada y en otro caso solamente se agrega como opción del dropdown.
     *
     * @param  mixed $nivel_id
     * @return void
     */
    function getNivelOptions($nivel_id) {
        require 'database.php';
        $consulta = "select * from NIVEL_PRIORIDAD";
        $resultado = mysqli_prepare($conexion, $consulta);

        if(!$resultado) {
            echo "Error: ".mysqli_error($conexion);
        }
        $ok = mysqli_stmt_execute($resultado);

        if(!$ok) {
            echo "Error";
        } else {
            $ok = mysqli_stmt_bind_result($resultado, $r_id, $r_nivel);
            while ($fila = mysqli_stmt_fetch($resultado)) {
                if ($r_id == $nivel_id) {
                    echo "<option value='$r_id' selected>$r_nivel</option>";
                } else {
                    echo "<option value='$r_id'>$r_nivel</option>";
                }
            }
        }
    }
?>