<?php
  include('menu.php');
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="js/validaciones.js"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/general.css">
  <title>Proceso</title>
</head>
<body>
  <div class="container"> 
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-4">
        <br>
        <form class="cajaProcesoMenu" enctype="multipart/form-data" action="menu_mantenedores_disparador.php" method="POST">
          <h2 class="cargaH2">Mantenedores de usuarios</h2>
          <br>
          <p> <input class="botonAceptarCarga" type="submit" name ="creaUsuario" value="Crear usuario" /></p>
          <p> <input class="botonAceptarCarga" type="submit" name ="modificaUsuario" value="Modifica usuario" /></p>
          <p> <input class="botonAceptarCarga" type="submit" name ="eliminaUsuario" value="Elimina usuario" /></p>
          <p> <input class="botonAceptarCarga" type="submit" name ="resetClave" value="Reset clave" /></p>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>