<?php
    session_start();
    if(isset($_SESSION["tipo"])){
        if ($_SESSION['tipo'] == 1){
        header('location: admin/crear.php');
       }elseif($_SESSION["tipo"] == 2){
        header('location: asistente/trasladospendientes.php');
       }elseif($_SESSION["tipo"] == 3){
        header('location: enfer/agregar.php');
       }
    }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Proyecto Desarrollo de Aplicaciones Web</title>
        <link rel="stylesheet" href="/estilos/estilos.css">
        <script src="js/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                  <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">          
                      <div class="mb-md-5 mt-md-4 pb-5">          
                        <h2 class="fw-bold mb-2 text-uppercase">Iniciar Sesión</h2>          
                        <form id = login method = "POST" action="../WebServices/login.php">
                        <div class="form-outline form-white mb-4">
                          <input type="text" id="usuario" name = "usuario" class="form-control form-control-lg" />
                          <label class="form-label" for="usuario">Usuario</label>
                        </div>          
                        <div class="form-outline form-white mb-4">
                          <input type="password" id="passwd" name="passwd" class="form-control form-control-lg"/>
                          <label class="form-label" for="typePasswordX">Contraseña</label>
                        </div>          
                        <input class="btn btn-outline-light btn-lg px-5" id="login" name="login" type="submit" value="Ingresar">    
                        <br>
                        <span>
                          <?php
                          if(isset($_SESSION['mensaje'])){
                            echo $_SESSION['mensaje'];
                          }
                          unset($_SESSION['mensaje']);
                          ?>
                        </span>      
                        </form>
                      </div>        
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
    </body>
</html>