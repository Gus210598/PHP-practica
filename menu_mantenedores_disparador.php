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
    
    include('menu.php');
   
    if ($_SESSION['tipoUsuario']=="ADM"){
      if(isset($_POST['creaUsuario'])){
        // header("Location:mantenedor_crea.php");
        // exit;
        echo "<script>
                window.location='mantenedor_crea.php';
              </script>";
      } else if (isset($_POST['modificaUsuario'])){
        // header("Location:mantenedor_busca_usr_a_mod.php");
        // exit;
        echo "<script>
                window.location='mantenedor_busca_usr_a_mod.php';
              </script>";
      } else if (isset($_POST['eliminaUsuario'])){
        // header("Location:mantenedor_busca_usr_a_elim.php");
        // exit;
        echo "<script>
                window.location='mantenedor_busca_usr_a_elim.php';
              </script>";
        
      } else if (isset($_POST['resetClave'])){
        // header("Location:mantenedor_busca_usr_a_reset_pass.php");
        // exit;
        echo "<script>
                window.location='mantenedor_busca_usr_a_reset_pass.php';
              </script>";
        
      } 
    } else {      
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
      header("Location:inicio.php");
      exit;
     } 
  ?>
</body>
</html>






