<?php
  include ('menu.php');
  $usuario = $_GET['user'];
  include('conexion.php');
  //Busca nuevamente el usuario para no pasarlo por GET
  $consulta="SELECT * FROM acceso WHERE usuario='$usuario'";
  $ejecutar=$conexion->query($consulta);
  mysqli_close($conexion);
  $registro=$ejecutar->fetch_assoc();
  $nombreUsuario=$registro['nombre_usuario'];
  $tipoUsuario=$registro['tipo_usuario'];
?>
<!doctype html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="js/validaciones.js"></script>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/general.css">
  <title>Modifica usuario</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-4">
        <form name='formCrea' class='cajaFormularioMantenedores'  action='' method='post'>
          <table class='table table-hover table-sm table-bordered' >
          <h2 class="cargaH2">Mantenedores de usuarios</h2>
            <h3>Usuario ya existe!!!</h3>
            <h5>Muestran los datos sin la clave de acceso</h5>
            <tr>
              <td>Usuario</td>
              <td><?php echo $usuario?></td>
            </tr>
            <tr>
              <td>Nombre usuario </td>
              <td><?php echo $nombreUsuario?></td>            
            </tr>
            <tr>
              <td>Tipo usuario </td>
              <td><?php echo $tipoUsuario?></td>
            </tr>
            <?php echo "<input type='hidden' id='usuario' name='usuario' value='".$usuario."' >";?>
          </table>
          <div class="contenedor2">
            <input class='alinear-boton btn btn-success' type="button" onclick="history.back()" name="volver atrás" value="Volver atrás">
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

