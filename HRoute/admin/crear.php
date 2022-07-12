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
            $("#crearCamillero").validate({
              rules: {
                nomUsuario: {
                  required: true
                },
                nomCamillero: {
                  required: true
                }
              },
              messages: {
                nomUsuario: {
                  required: "Porfavor ingrese un usuario"
                },
                nomCamillero: {
                  required: "Porfavor ingrese un nombre"
                }
              }
            });
          });
    </script>
</head>

<body>
    <?php
    require '../../WebServices/agregarCamillero.php';
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
        <form id="crearCamillero" class="form-inline" method="POST">
            <br>
            <div class="col">
                <label class="my-1 mr-2">Nombre de Usuario: </label>
                <input id="nomUsuario" name="nomUsuario" type="text" class="form-control">
            </div>
            <div class="col">
                <label class="my-1 mr-2">Nombre de Camillero: </label>
                <input id="nomCamillero" name="nomCamillero" type="text" class="form-control">
            </div>
            <br>
            <div class="col-12">
                <button id="btnGuardar" name="btnGuardar" type="submit" class="btn btn-success float-right">Agregar Camillero</button>
            </div>
        </form>
    </div>
</body>

</html>