<?php
      include ('menu.php');
      $usuario = $_GET['user'];
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

  <script src="sweetalert/sweetalert2.all.min.js"></script>
  <link href="sweetalert/sweetalert2.min.css">
  <title>Modifica usuario</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-4">
        <form name='formCrea' class='cajaFormularioMantenedores' enctype="multipart/form-data" action='' method='post' onsubmit='return validaFormularioCrear()'>
          <table class='table table-hover table-sm table-bordered' >
            <h2 class="cargaH2">Mantenedores de usuarios</h2>
            <h3>Usuario a crear</h3>
            <tr>
              <td>Usuario</td>
              <td><?php echo $usuario?></td>
            </tr>
            <tr>
              <td>Nombre usuario </td>
              <td><input class='fondoInput' type='text' id='nombreUsuario' name='nombreUsuario' placeholder='N.APELLIDO'
              size='30' onkeyup=mayusculas(this); required></td>
            </tr>
            <tr>
              <td>Tipo usuario </td>
                <td><div class="btn-group btn-group-toggle" data-toggle="buttons">
                  <label class="btn btn-info fondoRadio">
                  <input type="radio" name="tipoUsuario" value="USR" autocomplete="off"> USR</label>
                  <label class="btn btn-info active fondoRadio">
                  <input type="radio" name="tipoUsuario" value="ADM" autocomplete="off"> ADM</label>
                </div></td>
            </tr>
            <tr>
              <td>Clave </td>
              <td><input class='fondoInput' type='password' id='clave1' name='clave1' placeholder='Clave acceso'
              size='15' required></td>
            </tr>
            <tr>
              <td>Repita Clave </td>
              <td><input class='fondoInput' type='password' id='clave2' name='clave2' placeholder='Clave acceso'
              size='15' required></td>
            </tr>
            <?php echo "<input type='hidden' id='usuario' name='usuario' value='".$usuario."' >";?>

          </table>
          <div class='contenedor2'><button name='creaUsuario' id='' type='submit' class='alinear-boton btn btn-success'>Grabar</button>
          <input class='alinear-boton btn btn-success' type="button" onclick="history.back()" name="volver atrás" value="Volver atrás"></div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php
  //Captura información del formulario anterior 
  if(isset($_POST['creaUsuario'])){
    $usuario = $_POST['usuario'];
    $clave = sha1($_POST['clave1']);
    $nombreUsuario = $_POST['nombreUsuario'];
    $tipoUsuario = $_POST['tipoUsuario']; 
    include('conexion.php');
    $consulta="INSERT INTO acceso (usuario, clave, nombre_usuario, tipo_usuario) 
    VALUE ('".$usuario."', '".$clave."','".$nombreUsuario."','".$tipoUsuario."')";
    $ejecutar=$conexion->query($consulta);
    mysqli_close($conexion);
    if ($ejecutar){
      echo "<script>
      Swal.fire({
        type: 'success',
        title: 'Usuario creado correctamente',

      }).
      then(function(result){
        if(result.value){
        window.location='menu_adm_mantenedores.php';
        }})
      </script>";
    }else{
      echo "<script>
      Swal.fire({
        type: 'error',
        title: 'Error al crear usuario',

      }).
      then(function(result){
        if(result.value){
        window.location='inicio.php';
        }})
      </script>";
    }
  } 
  ?>
  