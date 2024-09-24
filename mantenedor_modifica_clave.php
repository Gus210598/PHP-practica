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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/general.css">

  <script src="sweetalert/sweetalert2.all.min.js"></script>
  <link href="sweetalert/sweetalert2.min.css">
  <title>Proceso</title>
</head>

<body>
  <div class="container"> 
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-4">
        <form id="frmModificaClave" name="mantenedorModifica" class="cajaFormularioMantenedores" enctype="multipart/form-data" action="" method="POST" onsubmit="return validaFrmModificaClave()">
          <table class='table table-hover table-sm table-bordered' >
           <h2 class="cargaH2">Mantenedores de usuarios</h2>
            <br></br>
            <h3>Cambio de clave</h3>
            <tr>
              <td>Usuario</td>
              <td><?php echo $_SESSION['usuario']?></td>
            </tr>
         
            <tr>
              <td>Clave actual</td>
              <td><input class="fondoInput" type='password' id='claveActual' name='claveActual' placeholder='Clave actual'
              size='15' required></td>
            </tr>
            <tr>
              <td>Clave</td>
              <td><input class="fondoInput" type='password' id='clave1' name='clave1' placeholder='Nueva clave'
              size='15' required></td>
            </tr>
            <tr>
              <td>Repita clave </td>
              <td><input class="fondoInput" type='password' id='clave2' name='clave2' placeholder='Repita clave'
              size='15' required></td>
            </tr>
          </table>
          <div class="contenedor2">
            <button name='modificaRegistro' id='' type='submit' class='btn btn-success'>Aceptar</button>
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

  if(isset($_POST['modificaRegistro'])){
    //Captura información del formulario anterior 
    $usuario = $_SESSION['usuario'];
    $claveNueva= sha1($_POST['clave1']);
    $claveActual = sha1($_POST['claveActual']);
    $claveUsrActual= $_SESSION['claveUsrActual'];

    if($claveActual==$claveUsrActual){
      include('conexion.php');
      $consulta="UPDATE acceso SET clave='$claveNueva' WHERE usuario='$usuario'";
      $ejecutar=$conexion->query($consulta);
      mysqli_close($conexion);
      if ($ejecutar){
        echo "<script>
        Swal.fire({
          type: 'success',
          title: 'Actualizada correctamente la clave de acceso',

        }).
        then(function(result){
          if(result.value){
          window.location='menu_mantenedores.php';
          }})
        </script>";
      }else{
        echo "<script>
        Swal.fire({
          type: 'error',
          title: 'Error al actualizar la clave',

        }).
        then(function(result){
          if(result.value){
          window.location='inicio.php';
          }})
        </script>";
      }
    } else {
      echo "<script>
        Swal.fire({
          type: 'error',
          title: 'La clave actual no corresponde',

        }).
        then(function(result){
          if(result.value){
          window.location='mantenedor_modifica_clave.php';
          }})
        </script>";
    }
  }
?>