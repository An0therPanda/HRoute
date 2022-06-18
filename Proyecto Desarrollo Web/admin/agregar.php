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
<body">
    <?php
        require '../../WebServices/select lugar.php';
        require '../../WebServices/select tipo traslado.php';
        require '../../WebServices/select trabajador.php';
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand">HRoute</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="agregar.php">Agregar Traslado</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="activos.php">Ver Trabajadores</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="traslados.php">Ver Traslados</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <br>
      <div class="container-fluid">
        <form class="form-inline" action="../../WebServices/agregarTraslado.php" method="POST">
            <div class="form row">
                <div class="col">
                    <label class="my-1 mr-2" >Origen: </label>
                    <select id="oriTraslado" name="oriTraslado" class="form-select col" aria-label="Default select example">
                    <option selected disabled>Seleccione un Origen</option>
                    <?php
                        getLugaresOptions(0);
                    ?>
                </select>
                </div>                
                <div class="col">
                    <label class="my-1 mr-2" >Destino: </label>
                    <select id="desTraslado" name="desTraslado" class="form-select " aria-label="Default select example">
                    <option selected disabled>Seleccione un Origen</option>
                    <?php
                        getLugaresOptions(0);
                    ?>
                    </select>
                </select>
                </div>
            </div>
            <br>
            <div class="form row">
                <div class="col">
                    <label class="my-1 mr-2" >Tipo de Traslado: </label>
                    <select id="tipoTraslado" name="tipoTraslado" class="form-select col" aria-label="Default select example">
                    <option selected disabled>Seleccione un Tipo de Traslado</option>
                    <?php
                        getTipoTrasladosOptions(0);
                    ?>
                    </select>
                </div>
                <div class="col">
                    <label class="my-1 mr-2" >Trabajador a Cargo: </label>
                    <select id="trabajadorTraslado" name="trabajadorTraslado" class="form-select col" aria-label="Default select example">
                    <option selected disabled>Seleccione el Personal a Cargo</option>
                    <?php
                        getTrabajadorOptions(0);
                    ?>
                    </select>
                </div>
            </div>
            <br>
            <div class="form row">
                <div class="col">
                    <label class="my-1 mr-2" >Nombre Personal: </label>
                    <input id="nomPersonal" name="nomPersonal" type="text" class="form-control" placeholder="">
                </div>                
                <div class="col">
                    <label class="my-1 mr-2" >Nombre del Paciente u Otros: </label>
                    <input id="nomPaciente" name="nomPaciente" type="text" class="form-control" placeholder="">
                </div>
            </div>
            <input type="hidden" id="txtId">
            <br>   
            <div class="col-12">
                <button id="btnGuardar" type="submit" class="btn btn-success float-right">Guardar</button>
            </div>
          </form>
    </div>
    <br>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="../js/app.js"></script>
</body>
</html>