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
    //Disparadores a los menú de mantenedores 
    if(isset($_POST['mantenedorModifica'])){
      // header("Location:mantenedor_modifica_clave.php");
      // exit;
      echo "<script>
          window.location='mantenedor_modifica_clave.php';
        </script>";
    }
    include('menu.php');
    if(isset($_POST['mantenedorMenuAdm'])){
      if ($_SESSION['tipoUsuario']!="ADM"){
        echo "<script>
        Swal.fire({
          type: 'error',
          title: 'Usuario no autorizado, contacte al administrador',
        }).
        then(function(result){
          if(result.value){
          window.location='menu_mantenedores.php';
          }})
        </script>";
      } else {
        // header("Location:menu_adm_mantenedores.php");
        // exit;
        echo "<script>
          window.location='menu_adm_mantenedores.php';
        </script>";
      }
    }
  ?>
  
</body>
</html>






