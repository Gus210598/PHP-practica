<?php
  include ('menu.php');
  //Captura información del formulario anterior 
  if(isset($_POST['creaUsuario'])){
    $usuario = $_POST['usuario'];
    $clave = sha1($_POST['clave1']);
    $nombreUsuario = $_POST['nombreUsuario'];
    $tipoUsuario = $_POST['tipoUsuario'];
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
  <title>Modifica clave</title>
</head>
<body>
  <?php
    include('conexion.php');
    $consulta="INSERT INTO acceso (usuario, clave, nombre_usuario, tipo_usuario) 
    VALUE ('".$usuario."', '".$clave."','".$nombreUsuario."','".$tipoUsuario."')";
    $ejecutar=$conexion->query($consulta);
    mysqli_close($conexion);
    if ($ejecutar==true){
      echo "<script>
      Swal.fire({
        type: 'success',
        title: 'Usuario creado correctamente',

      }).
      then(function(result){
        if(result.value){
        window.location='inicio.php';
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
  ?>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>

