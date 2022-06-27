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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <?php
    require '../../WebServices/select lugar.php';
    require '../../WebServices/select tipo traslado.php';
    require '../../WebServices/select trabajador.php';
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
        <form class="form-inline" action="../../WebServices/agregarCamillero.php" method="POST">
            <br>
            <div class="col">
                <label class="my-1 mr-2">Nombre de Usuario: </label>
                <input id="nomUsuario" name="nomUsuario" type="text" class="form-control" placeholder="">
            </div>
            <div class="col">
                <label class="my-1 mr-2">Nombre de Camillero: </label>
                <input id="nomCamillero" name="nomCamillero" type="text" class="form-control" placeholder="">
            </div>
            <br>
            <div class="col-12">
                <button id="btnGuardar" type="submit" class="btn btn-success float-right">Agregar Camillero</button>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/app.js"></script>
</body>

</html>