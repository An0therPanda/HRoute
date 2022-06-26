<?php
    session_start();
    if(isset($_SESSION["tipo"])){
        if ($_SESSION['tipo'] == 1){
            header('location: ../admin/crear.php');
        }
        if ($_SESSION["tipo"] == 3){
            header('location: ../enfer/agregar.php');
        }
    }else{
        header('location: ../index.php');
      }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRoute</title>
    <link rel="stylesheet" href="/estilos/estilos.css">

    <script src="../js/jquery.min.js"></script>
    <script src="../js/script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">HRoute</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="trasladospendientes.php">Traslados Pendientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="historialtraslados.php">Historial de Traslados</a>
                    </li>
                    <li class="nav-item">
                <a class="nav-link" href="../../WebServices/logout.php">Cerrar Sesión</a>
              </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="table-responsive table-bordered movie-table">
                <table class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Origen</th>
                            <th>Destino</th>   
                            <th>Nombre Personal</th>
                            <th>Nombre Paciente</th>
                            <th>Tipo de Traslado</th>
                            <th>OT Realizada</th>
                        </tr>
                    </thead> 
                    <?php
                    require '../../WebServices/database.php';
            
                    $consulta = "select traslados.ID, lugares1.LUGAR as ORIGEN, lugares2.LUGAR as DESTINO, tipo_traslados.TIPO_TRASLADO as TipoTraslado, usuarios.NOMBRE, NOMBRE_PERSONAL, NOMBRE_PACIENTE, REALIZADA
                    from traslados
                    inner join lugares AS lugares1 on traslados.ORIGEN = lugares1.ID
                    inner join lugares as lugares2 on traslados.DESTINO = lugares2.ID
                    inner join tipo_traslados on traslados.TIPO_TRASLADO = tipo_traslados.ID
                    inner join usuarios on traslados.NOMBRE_TRABAJADOR = usuarios.ID
                    where traslados.NOMBRE_TRABAJADOR = ".$_SESSION['id']." AND traslados.realizada = 0
                    order by traslados.ID";

                    $resultado = mysqli_prepare($conexion, $consulta);

                    if(!$resultado){
                        echo "Error: ".mysqli_error($conexion);
                    }
                    $ok = mysqli_stmt_execute($resultado);

                    if(!$ok){
                        echo "Error";
                    }else{
                        $ok = mysqli_stmt_bind_result($resultado, $r_id, $r_origen, $r_destino, $r_tipotraslado, $r_nombretrabajador, $r_nombrepersonal, $r_nombrepaciente, $r_realizada);
                        while ($fila = mysqli_stmt_fetch($resultado)){
                            echo "<tr><th>";
                            echo $r_id."</th><th>";
                            echo $r_origen."</th><th>";
                            echo $r_destino."</th><th>";
                            echo $r_nombrepersonal."</th><th>";
                            echo $r_nombrepaciente."</th><th>";
                            echo $r_tipotraslado."</th><th>";
                            echo "<a href='../../WebServices/completarTraslado.php?id=".$r_id."'>Completar</a></th>";             
                        }
                    }
                    mysqli_stmt_close($resultado);
                ?>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>