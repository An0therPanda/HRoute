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
  <title>HRoute</title>
  <link rel="stylesheet" href="/estilos/estilos.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
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
  <br />
  <div class="container-fluid">
    <table class="table table-responsive table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre Trabajador</th>
          <th>Con Traslados Asignados</th>
        </tr>
      </thead>
      <tbody>
        <?php
        require '../../WebServices/database.php';
        $consulta = 'select id, nombre from usuarios where TIPO_USUARIO = 2';
        $resultado = mysqli_prepare($conexion, $consulta);

        if (!$resultado) {
          echo "Error";
        }

        $trabajadores = [];
        $ok = mysqli_stmt_execute($resultado);

        if (!$ok) {
          echo "Error en la consulta";
        } else {
          $ok = mysqli_stmt_bind_result($resultado, $r_id, $r_nombre);
          while (mysqli_stmt_fetch($resultado)) {
            $trabajadores[] = [
              'id' => $r_id,
              'nombre' => $r_nombre
            ];
          }
        }
        mysqli_stmt_close($resultado);

        for ($i = 0; $i < count($trabajadores); $i++) {
          $consulta1 = "select count(id) from traslados where nombre_trabajador = " . $trabajadores[$i]['id'] . " and realizada = 0";
          $resultado1 = mysqli_prepare($conexion, $consulta1);
          $ok1 = mysqli_stmt_execute($resultado1);
          $ok1 = mysqli_stmt_bind_result($resultado1, $r_count);
          while (mysqli_stmt_fetch($resultado1)) {
            $traslados = $r_count;
          }
          echo "<tr>";
          echo "<td>" . $trabajadores[$i]['id'] . "</td>";
          echo "<td>" . $trabajadores[$i]['nombre'] . "</td>";
          echo "<td>" . ($traslados > 0 ? 'Sí' : 'No') . "</td>";
          echo "<th><a href='modificarCamillero.php?id=" . $trabajadores[$i]['id'] . "'>Modificar</a> </th>";
          echo "<th><a href='../../WebServices/eliminarCamillero.php?id=" . $trabajadores[$i]['id'] . "'>Eliminar</a> </th>";
          echo "</tr>";
          mysqli_stmt_close($resultado1);
        }
        ?>
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>