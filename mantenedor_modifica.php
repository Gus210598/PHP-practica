<?php
      include ('menu.php');
?>
<!doctype html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/general.css">

  <title>Modifica usuario</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-5">
        <form name='formModifica' class='' enctype="multipart/form-data" action='mantenedor_mod_clave.php' method='post'>
          <table class='table table-hover table-sm table-bordered' >
            <br></br>
            <br></br>
            <h3>Usuario a modificar</h3>
            <tr>
            <td>Usuario</td>
            <td><?php echo $_SESSION['usuario']?></td>
            </tr>

            <tr>
            <td>Clave </td>
            <td><input type='password' id='clave' name='clave' placeholder='Clave acceso'
            size='15' required></td>
            </tr>
          </table>
          <button name='modificaRegistro' id='' type='submit' class='alinear-boton btn btn-success'>Aceptar</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

