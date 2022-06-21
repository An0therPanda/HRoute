<?php 

    if(isset($_POST['login'])){
        session_start();
        require('database.php');

        $usuario = $_POST['usuario'];
        $passwd = $_POST['passwd'];

        $consulta = "select id, usuario, contrasena, tipo_usuario from usuarios where usuario = ? and contrasena = ?";

        $resultado = mysqli_prepare($conexion, $consulta);
        
        

        $ok = mysqli_stmt_bind_param($resultado,"ss", $usuario, $passwd);
        $ok = mysqli_stmt_execute($resultado);
        $ok = mysqli_stmt_bind_result($resultado, $r_id, $r_usuario, $r_contra, $r_tipo);

        if(!mysqli_stmt_fetch($resultado)){
            $_SESSION['mensaje'] = "Login Fallido, Usuario no encontrado";
            header('location: ../Proyecto Desarrollo Web/index.php');
        }else{

            setcookie("usuario", $r_usuario, time() + (86400 * 30)); 
            setcookie("contra", $r_contra, time() + (86400 * 30));

            $_SESSION['id'] = $r_id;
            $_SESSION['tipo'] = $r_tipo;
            if($r_tipo == 1){
                header('location: ../Proyecto Desarrollo Web/admin/agregar.php');
            }else{
                header('location: ../Proyecto Desarrollo Web/asistente/trasladospendientes.php');
            }
        }
        mysqli_stmt_close($resultado);

        $consulta1 = "update USUARIOS set CONECTADO = 1 where ID = ".$_SESSION['id']."";
        $resultado1 = mysqli_prepare($conexion, $consulta1);
        $ok1 = mysqli_stmt_execute($resultado1);
        mysqli_stmt_close($resultado1);

    }else{
        $_SESSION['mensaje'] = "Ingrese Sesión Primero";
        header('location: ../Proyecto Desarrollo Web/index.php');
    } 
?>