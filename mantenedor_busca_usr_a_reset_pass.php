<?php
  include ('sesion.php');
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

  <script src="sweetalert/sweetalert2.all.min.js"></script>
  <link href="sweetalert/sweetalert2.min.css">

  <title>Modifica usuario</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <br>
      </div>
      <div class="col-md-4">
        <form class='cajaFormularioMantenedores' enctype="multipart/form-data" action='' method='post'>
          <table class='table table-hover table-sm table-bordered' >
          <h2 class="cargaH2">Mantenedores de usuarios</h2>
 
            <br></br>
            <h3>Reset clave de usuario</h3>
            <tr>
              <td>Usuario</td>
              <td><input class="fondoInput" type='text' id='usuario' name='usuario' placeholder='Usuario'
              size='10' onkeyup=mayusculas(this); required></td>
           </tr>
         
          </table>
          <div class="contenedor2">
            <button name='resetPass' id='' type='submit' class='alinear-boton btn btn-success'>Aceptar</button>
            <input class='alinear-boton btn btn-success' type="button" onclick="history.back()" name="volver atrás" value="Volver atrás">
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php
  if(isset($_POST['resetPass'])){
    $usuario = ($_POST['usuario']);

    include('conexion.php');
    //Se busca que usuario si existe o no
    $consulta="SELECT * FROM acceso WHERE usuario='$usuario'";
    $ejecutar=$conexion->query($consulta);
    mysqli_close($conexion);

    if ($usuario==$_SESSION['usuario']){
      echo "<script>
      Swal.fire({
        type: 'error',
        title: 'El adiministrador a resetear la clave no puede estar en líena!!!',

      }).
      then(function(result){
        if(result.value){
        window.location='menu_mantenedores.php';
        }})
      </script>";
    } else if ($ejecutar->num_rows>0){
      // header("Location:mantenedor_reset_clave.php?user=$usuario");
      echo "<script>
              window.location='mantenedor_reset_clave.php?user=$usuario';
            </script>";
    }else{
      echo "<script>
      Swal.fire({
        type: 'warning',
        title: 'El usuario ingresado no existe!!!',

      }).
      then(function(result){
        if(result.value){
        window.location='mantenedor_busca_usr_a_reset_pass.php';
        }})
      </script>";
    }       
  }
?>