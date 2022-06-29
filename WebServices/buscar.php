<?php
    if(array_key_exists('btnGuardar', $_GET)) {
        buscar();
    }
    
    function buscar(){
        $id = $_GET['id'];
            
        require 'database.php';
    
        $consulta = "select * from usuarios where TIPO_USUARIO = ?";
    
        $resultado = mysqli_prepare($conexion, $consulta);
    
        if(!$resultado){
            echo "Error";
        }
    
        $ok = mysqli_stmt_bind_param($resultado, "i", $id);
        $ok = mysqli_stmt_execute($resultado);
    
        if(!$ok){
            echo "Error en la consulta";
        }else{
            $ok = mysqli_stmt_bind_result($resultado, $r_id, $r_usuario, $r_passw, $r_nombre, $r_tipousuario);
    
            echo "<table>";
            while(mysqli_stmt_fetch($resultado)){
                echo "<tr><td>";
                echo $r_id."</td><td>";
                echo $r_usuario."</td><td>";
                echo $r_passw."</td><td>";
                echo $r_nombre."</td><td>";
                echo $r_tipousuario."</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        mysqli_stmt_close($resultado);
    }
?>