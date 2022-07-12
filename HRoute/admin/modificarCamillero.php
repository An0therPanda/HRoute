<?php
session_start();
if (isset($_SESSION["tipo"])) {
    if ($_SESSION["tipo"] == 2) {
        header('location: ../asistente/trasladospendientes.php');
    }
    if ($_SESSION["tipo"] == 3) {
        header('location: ../enfer/agregar.php');
    }
} else {
    header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/estilos/estilos.css">
    <title>HRoute</title>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script>
          $(document).ready(function() {
            $("#modificarCamillero").validate({
              rules: {
                id:{
                    required: true
                },
                estado:{
                    required: true
                },
                contrasena:{
                    required: true
                },
                nomUsuario: {
                  required: true
                },
                nomCamillero: {
                  required: true
                }
              },
              messages: {
                id:{
                    required: "Porfavor, ingrese un id"
                },
                estado:{
                    required: "Porfavor, ingrese un estado"
                },
                contrasena:{
                    required: "Porfavor, ingrese una contraseña"
                },
                nomUsuario: {
                  required: "Porfavor, ingrese un usuario"
                },
                nomCamillero: {
                  required: "Porfavor, ingrese un nombre"
                }
              }
            })
            $('#btnModal').on('click', function() {
                if($("#modificarCamillero").valid()){
                    var btn = document.getElementById("btnModal");
                    btn.setAttribute("data-bs-target","#myModal");
                }
            });
          });
    </script>
</head>

<body>
    <?php
    $id = $_GET['id'];

    require '../../WebServices/database.php';
    require '../../WebServices/selecttrabajador.php';
    require '../../WebServices/eliminarCamillero.php';
    require '../../WebServices/editarCamillero.php';

    $consulta = "select id, usuario, contrasena, nombre, conectado from usuarios where usuarios.id = ?";

    $resultado = mysqli_prepare($conexion, $consulta);

    if (!$resultado) {
        echo "Error: " . mysqli_error($conexion);
    }
    $ok = mysqli_stmt_bind_param($resultado, "i", $id);
    $ok = mysqli_stmt_execute($resultado);
    if (!$ok) {
        echo "Error: " . mysqli_error($conexion);
    } else {
        $ok = mysqli_stmt_bind_result($resultado, $r_id, $r_usuario, $r_contrasena, $r_nombre, $r_estado);
        while ($fila = mysqli_stmt_fetch($resultado)) {

    ?>

            <nav class="navbar navbar-expand-lg navbar-light bg-info text-white">
                <div class="container-fluid">
                    <a class="navbar-brand">HRoute</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="crear.php">Agregar Camillero</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="activos.php">Ver Trabajadores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="traslados.php">Traslados Activos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="historial.php">Historial de Traslados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../../WebServices/logout.php">Cerrar Sesión</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <br>
            <div class="container-fluid">
                <form id="modificarCamillero" class="form-inline" method="POST">
                    <div class="form row">
                        <div class="col">
                            <label class="my-1 mr-2">ID de Camillero: </label>
                            <?php
                            echo "<input id='id' name='id' value='" . $r_id . "' readonly type='text' class='form-control'>";
                            ?>
                        </div>

                    </div>
                    <br>
                    <div class="col">
                        <label class="my-1 mr-2">Estado: </label>
                        <select id="estado" name="estado" class="form-select col" aria-label="Default select example">
                            <?php
                            $desconectado = 0;
                            $conectado= 1;

                            if ($r_estado == 0) {
                                echo "<option selected value='" . $desconectado . "'>Desconectado</option>";
                                echo "<option value='" . $conectado . "'>Conectado</option>";
                            } else {
                                echo "<option value=" . $desconectado . ">Desconectado</option>";
                                echo "<option selected value=" . $conectado . ">Conectado</option>";
                            }
                            ?>
                        </select>
                    </div>
            <?php
        }
    }
            ?>
            <br>
            <div class="form row">
                <div class="col">
                    <label class='my-1 mr-2'>Nombre del Trabajador: </label>
                    <?php
                    echo "<input id='contrasena' name='contrasena' type='text' class='form-control' value='" . $r_contrasena . "' placeholder='" . $r_contrasena . "'>";
                    ?>

                </div>

                <div class="col">
                    <?php
                    echo "<label class='my-1 mr-2' >Contraseña Usuario: </label>";
                    echo "<input id='nomUsuario' name='nomUsuario' type='text' class='form-control' value='" . $r_usuario . "' placeholder='" . $r_usuario . "'>";
                    ?>

                </div>
            </div>
            <br>
            <div class="col">
                <?php
                echo "<label class='my-1 mr-2' >Nombre del Camillero: </label>";
                echo "<input id='nomCamillero' name='nomCamillero' type='text' class='form-control' value='" . $r_nombre . "' placeholder='" . $r_nombre . "'>";
                ?>

            </div>


            <br>
            <div class="col-12">
                <button id="btnModal" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Modificar</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEliminar">Eliminar</button>
            </div>
            <!-- The Modal -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Confirmar Acción</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            ¿Está seguro que desea modificar los datos del camillero?
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button id="btnGuardar" name="btnGuardar" type="submit" class="btn btn-success">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="modal fade" id="modalEliminar">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Confirmar Acción</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            ¿Está seguro que desea eliminar al camillero?
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button id="btnEliminar" name="btnEliminar" type="submit" class="btn btn-success">Eliminar</button>
                        </div>

                    </div>
                </div>
            </div>
            
                </form>
            </div>
            <br>
            </div>
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>