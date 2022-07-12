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
            $("#modificarTraslado").validate({
              rules: {
                id: {
                    required: true
                },
                oriTraslado: {
                  required: true
                },
                desTraslado: {
                  required: true
                },
                tipoTraslado: {
                    required: true
                },
                idPrioridad: {
                    required: true
                },
                nomPersonal: {
                    required: true
                },
                realizada: {
                    required: true
                }
              },
              messages: {
                id: {
                    required: "Porfavor, ingrese un id"
                },
                oriTraslado: {
                  required: "Porfavor, ingrese un origen"
                },
                desTraslado: {
                  required: "Porfavor, ingrese un destino"
                },
                tipoTraslado: {
                  required: "Porfavor, ingrese un tipo de traslado"
                },
                idPrioridad: {
                  required: "Porfavor, ingrese una prioridad"
                },
                nomPersonal: {
                  required: "Porfavor, ingrese su nombre"
                },
                realizada: {
                    required: "Porfavor, ingrese un estado válido"
                }
              }
            })
            $('#btnModal').on('click', function() {
                if($("#modificarTraslado").valid()){
                    var btn = document.getElementById("btnModal");
                    btn.setAttribute("data-bs-target","#modalModificar");
                }
            });
          });
    </script>
</head>

<body>
    <?php
    $id = $_GET['id'];

    require '../../WebServices/database.php';
    require '../../WebServices/selectlugar.php';
    require '../../WebServices/selecttipotraslado.php';
    require '../../WebServices/selecttrabajador.php';
    require '../../WebServices/selectnivel.php';
    require '../../WebServices/eliminarTraslado.php';
    require '../../WebServices/editarTraslado.php';


    $consulta = "select traslados.ID, lugares1.LUGAR as ORIGEN, traslados.ORIGEN as IdOrigen, lugares2.LUGAR as DESTINO, traslados.DESTINO AS IdDestino, tipo_traslados.TIPO_TRASLADO as TipoTraslado, traslados.TIPO_TRASLADO as IdTipoTraslado, nivel_prioridad.nivel as NIVEL_P, traslados.NIVEL_PRIORIDAD as ID_NIVEL, FECHA, usuarios.NOMBRE, traslados.NOMBRE_TRABAJADOR as IdTrabajador, NOMBRE_PERSONAL, NOMBRE_PACIENTE, REALIZADA
        from traslados
        inner join lugares AS lugares1 on traslados.ORIGEN = lugares1.ID
        inner join lugares as lugares2 on traslados.DESTINO = lugares2.ID
        inner join tipo_traslados on traslados.TIPO_TRASLADO = tipo_traslados.ID
        inner join usuarios on traslados.NOMBRE_TRABAJADOR = usuarios.ID
        inner join nivel_prioridad on traslados.NIVEL_PRIORIDAD = nivel_prioridad.ID
        where traslados.ID = ?";

    $resultado = mysqli_prepare($conexion, $consulta);

    if (!$resultado) {
        echo "Error: " . mysqli_error($conexion);
    }
    $ok = mysqli_stmt_bind_param($resultado, "i", $id);
    $ok = mysqli_stmt_execute($resultado);
    if (!$ok) {
        echo "Error: " . mysqli_error($conexion);
    } else {
        $ok = mysqli_stmt_bind_result($resultado, $r_id, $r_origen, $r_idorigen, $r_destino, $r_iddestino, $r_tipotraslado, $r_idtipotraslado, $r_nivel, $r_idnivel, $r_fecha, $r_nombretrabajador, $r_idtrabajador, $r_nombrepersonal, $r_nombrepaciente, $r_realizada);
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
                <form id="modificarTraslado" class="form-inline" method="POST">
                    <div class="form row">
                        <div class="col">
                            <label class="my-1 mr-2">ID de Traslado: </label>
                            <?php
                            echo "<input id='id' name='id' value='" . $r_id . "' readonly type='text' class='form-control'>";
                            ?>
                        </div>
                    </div>
                    <br>
                    <div class="form row">
                        <div class="col">
                            <label class="my-1 mr-2">Origen: </label>
                            <select id="oriTraslado" name="oriTraslado" class="form-select col" aria-label="Default select example">
                                <option selected disabled>Seleccione un Origen</option>
                                <?php
                                getOrigenOptions($r_idorigen);
                                ?>
                            </select>
                        </div>

                        <div class="col">
                            <label class="my-1 mr-2">Destino: </label>
                            <select id="desTraslado" name="desTraslado" class="form-select " aria-label="Default select example">
                                <option selected disabled>Seleccione un Origen</option>
                                <?php
                                getDestinoOptions($r_iddestino);
                                ?>
                            </select>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form row">
                        <div class="col">
                            <label class="my-1 mr-2">Tipo de Traslado: </label>
                            <select id="tipoTraslado" name="tipoTraslado" class="form-select col" aria-label="Default select example">
                                <option selected disabled>Seleccione un Tipo de Traslado</option>
                                <?php
                                getTipoTrasladosOptions($r_idtipotraslado);
                                ?>
                            </select>
                        </div>
                        <div class="col">
                            <label class="my-1 mr-2">Nivel de Prioridad: </label>
                            <select id="idPrioridad" name="idPrioridad" class="form-select col" aria-label="Default select example">
                                <option selected disabled>Seleccione el nivel de prioridad</option>
                                <?php
                                getNivelOptions($r_idnivel);
                                ?>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="col">
                        <label class="my-1 mr-2">Trabajador a Cargo: </label>
                        <select id="trabajadorTraslado" name="trabajadorTraslado" class="form-select col" aria-label="Default select example">
                            <option selected disabled>Seleccione el Personal a Cargo</option>
                    <?php
                    getTrabajadorOptions($r_idtrabajador);
                }
            }
                    ?>
                        </select>

                    </div>



                    <br>

                    <div class="form row">
                        <div class="col">
                            <?php
                            echo "<label class='my-1 mr-2' >Nombre Personal: </label>";
                            echo "<input id='nomPersonal' name='nomPersonal' type='text' class='form-control' value='" . $r_nombrepersonal . "' placeholder='" . $r_nombrepersonal . "'>";
                            ?>

                        </div>

                        <div class="col">
                            <?php
                            echo "<label class='my-1 mr-2' >Nombre del Paciente u Otros: </label>";
                            echo "<input id='nomPaciente' name='nomPaciente' type='text' class='form-control' value='" . $r_nombrepaciente . "' placeholder='" . $r_nombrepaciente . "'>";
                            ?>

                        </div>
                    </div>
                    <br>
                    <div class="form row">
                        <div class="col">
                            <label class="my-1 mr-2">Estado del traslado: </label>
                            <?php
                            echo "<select id='realizada' name='realizada' class='form-select col' aria-label='Default select example'>";
                            if ($r_realizada == 0) {
                                echo "<option value='0' selected>Pendiente</option>";
                                echo "<option value='1'>Realizada</option>";
                            } else {
                                echo "<option value='1' selected>Realizada</option>";
                                echo "<option value='0'>Pendiente</option>";
                            }
                            echo "</select>";
                            ?>
                        </div>
                    </div>
                    <br>


                    <button id="btnModal" type="button" class="btn btn-primary" data-bs-toggle="modal">Modificar</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEliminar">Eliminar</button>
                    
                    <!-- The Modal -->
                    <div class="modal fade" id="modalModificar">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Confirmar Acción</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    ¿Está seguro que desea modificar el traslado?
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button id="btnGuardar" name="btnModificar" type="submit" class="btn btn-success">Confirmar</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- The Modal -->
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
                                    ¿Está seguro que desea eliminar el traslado?
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button id="btnGuardar" name="btnEliminar" type="submit" class="btn btn-success">Confirmar</button>
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