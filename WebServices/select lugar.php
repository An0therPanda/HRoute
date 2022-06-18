<?php
    function getLugaresOptions($lugar_id) {
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
?>