<?php
if(array_key_exists('btnGuardar', $_POST)) {
    editarCamillero();
}

/**
 * Función encargada de editar los datos de los camilleros ingresados en la base de datos.
 * 
 * A través del formulario que se rellena en la interfaz de modificar camillero se obtienen los datos del camillero.
 * Luego se realiza la conexión a la base de datos, donde se ingresa la consulta "update" utilizando los datos obtenidos desde el formulario. Una vez
 * ingresada la consulta, se realiza la misma a la base de datos. En el caso de no poder realizar la modificación, se manda un mensaje de error.
 * En el caso contrario, se redirige al usuario a la tabla de los camilleros conectados.
 * 
 * @return void
 */
function editarCamillero(){
    $id = $_POST['id'];
    $estado = $_POST['estado'];
    $contra = $_POST['contrasena'];
    $nomUsuario = $_POST['nomUsuario'];
    $nomCamillero = $_POST['nomCamillero'];
    
    require 'database.php';
    
    $consulta = "update USUARIOS set  USUARIO = ?, CONTRASENA = ?, NOMBRE = ?, CONECTADO = ? where ID = ?";
    
    $resultado = mysqli_prepare($conexion, $consulta);
    
    //Acceder a los registros
    
    if (!$resultado) {
        echo "Error al modificar: " . mysqli_error($conexion);
    } else {
        header('location: ../admin/activos.php');
    }
    
    $ok = mysqli_stmt_bind_param($resultado, "sssii", $nomUsuario, $contra, $nomCamillero, $estado, $id);
    $ok = mysqli_stmt_execute($resultado);
    
    if (!$ok) {
        echo "Error";
    } else {
        echo "OK";
    }
    mysqli_stmt_close($resultado);  
}


?>