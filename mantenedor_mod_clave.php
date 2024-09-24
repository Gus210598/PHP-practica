<?php
  include ('menu.php');
  //Captura información del formulario anterior 
  if(isset($_POST['modificaRegistro'])){
    $usuario = $_SESSION['usuario'];
    $clave = sha1($_POST['clave']);
  }
?>
<!doctype html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="js/validaciones.js"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/general.css">
  <script src="sweetalert/sweetalert2.all.min.js"></script>
  <link href="sweetalert/sweetalert2.min.css">
  <title>Modifica usuario</title>
</head>
<body>
  <?php
    include('conexion.php');
    //Se busca que usuario y contraseña corresponda
    $consulta="SELECT * FROM acceso WHERE usuario='$usuario' AND clave ='$clave'";
    $ejecutar=$conexion->query($consulta);
    mysqli_close($conexion);
    if ($ejecutar->num_rows>0){
      $registro=$ejecutar->fetch_assoc();
      $usuario_ = $registro['usuario'];
    }else{
      echo "<script>
      Swal.fire({
        type: 'error',
        title: 'Clave erronea intente nuevamente',

      }).
      then(function(result){
        if(result.value){
        window.location='mantenedor_modifica.php';
        }})
      </script>";
    }
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-5">
        <form name='formModifica' class='' enctype="multipart/form-data" action='mantenedor_actualiza_clave.php' method='post' onsubmit='return validaFormulario()'>
          <table class='table table-hover table-sm table-bordered' >
            <br></br>
            <br></br>
            <h3>Ingrese nueva clave</h3>
            <tr>
            <td>Usuario</td>
            <td><?php echo $usuario?></td>
            </tr>

            <tr>
            <td>Clave </td>
            <td>*****</td>
            </tr>

            <tr>
            <td>Nueva clave </td>
            <td><input type='password' id='clave' name='clave' placeholder='Clave'
            size='15' required></td>
            </tr>

            <tr>
            <td>Repita clave </td>
            <td><input type='password' id='clave1' name='clave1' placeholder='Clave'
            size='15' required></td>
            </tr>
            
            <?php echo "<input type='hidden' id='claveAntigua' name='claveAntigua' value='".$clave."' >";?>

          </table>
          <button name='modificaRegistros' id='' type='submit' class='alinear-boton btn btn-success'>Aceptar</button>
        </form>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

