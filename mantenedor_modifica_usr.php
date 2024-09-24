<?php
  include ('sesion.php');
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
      </div>
      <div class="col-md-4">
        <form name='formModUser' class='cajaFormularioMantenedores'  action='' method='post'>
          <table class='table table-hover table-sm table-bordered' >
          <h2 class="cargaH2">Mantenedores de usuarios</h2>
            <h3>Usuario a modificar</h3>
            <h5>Datos que se pueden modificar</h5>
            <tr>
              <td>Usuario</td>
              <td><?php echo $usuario?></td>
            </tr>
            <tr>
              <td>Nombre usuario </td>
              <td><?php echo "<input class='fondoInput' id='nombreUsuario' name='nombreUsuario' value='".$nombreUsuario."' size='30' onkeyup=mayusculas(this); required>";?></td>

                      
            </tr>
            <tr>
            <td>Tipo usuario </td>
                <td><div class="btn-group btn-group-toggle" data-toggle="buttons">
                  <label class="btn btn-info fondoRadio">
                  <input type="radio" name="tipoUsuario" value="USR" autocomplete="off"> USR</label>
                  <label class="btn btn-info active fondoRadio">
                  <input type="radio" name="tipoUsuario" value="ADM" autocomplete="off"> ADM</label>
                  <label>&nbsp &nbsp &nbsp Actualmente es <?php echo $tipoUsuario?></label>
                </div></td>
                
            </tr>
            <?php echo "<input type='hidden' id='usuario' name='usuario' value='".$usuario."' >";?>
          </table>
          <div class="contenedor2">
            <button name='buscaUsuario' id='' type='submit' class='alinear-boton btn btn-success'>Actualizar</button>
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
  if(isset($_POST['buscaUsuario'])){
    $usuario = ($_POST['usuario']);
    $nombreUsuario = ($_POST['nombreUsuario']);
    $tipoUsuario = ($_POST['tipoUsuario']);

    include('conexion.php');
    //Se busca que usuario si existe o no
    $consulta="UPDATE acceso SET nombre_usuario='$nombreUsuario', tipo_usuario='$tipoUsuario' WHERE usuario='$usuario'";
    $ejecutar=$conexion->query($consulta);
    mysqli_close($conexion);

    if ($ejecutar){
      $blanco="";
      echo "<script>
      Swal.fire({
        type: 'susses',
        title: 'Usuario correctamente modificado!!!',

      }).
      then(function(result){
        if(result.value){
        window.location='mantenedor_busca_usr_a_mod.php?user=$blanco';
        }})
      </script>";
          
    }else{
      echo "<script>
      Swal.fire({
        type: 'error',
        title: 'Error al actualizar registro!!!',

      }).
      then(function(result){
        if(result.value){
        window.location='inicio.php';
        }})
      </script>";
    }
         
  }
?>