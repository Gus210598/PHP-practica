<?php
include ('sesion.php');
?>
<!doctype html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <script src="sweetalert/sweetalert2.all.min.js"></script>
  <link href="sweetalert/sweetalert2.min.css">
</head>
<body>
<?php
  include('conexion.php');
  $usuario_ = $_POST['usuario'];
  $clave_ = sha1($_POST['clave']);
  /* ahora se buscan los datos ingresados en la base de
  datos para dar acceso */
  $consulta="SELECT * FROM acceso WHERE usuario='$usuario_' AND clave ='$clave_'";
  $ejecutar=$conexion->query($consulta);
  mysqli_close($conexion);
  if ($ejecutar->num_rows>0){
    $registro_=$ejecutar->fetch_assoc();
    $nombres_ = $registro_['nombre_usuario'];
    $usuario_ = $registro_['usuario'];
    $tipoUsuario_ = $registro_['tipo_usuario'];
    
    // session_start();
    $_SESSION['nombres'] = $nombres_;
    $_SESSION['usuario'] = $usuario_;
    $_SESSION['tipoUsuario'] = $tipoUsuario_;
    $_SESSION['logged in'] = true;
    // echo $_SESSION['logged in'];
    // x  $url="inicio.php";
    echo "<script>
          window.location='inicio.php';
        </script>";
  }else{
    echo "<script>
    Swal.fire({
      type: 'error',
      title: 'Usuario  o clave de acceso erroneo',

    }).
    then(function(result){
      if(result.value){
      window.location='index.php';
      }})
    </script>";
  }
?>
</body>
</html>
