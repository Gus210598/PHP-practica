<?php
  include ('sesion.php');
  include ('menu.php');
  //Captura información del formulario anterior 
  if(isset($_POST['buscaUsuario'])){
    $usuario = ($_POST['usuario']);
  }
    include('conexion.php');
    //Se busca que usuario si existe o no
    $consulta="SELECT * FROM acceso WHERE usuario='$usuario'";
    $ejecutar=$conexion->query($consulta);
    mysqli_close($conexion);
   
    if ($ejecutar->num_rows>0){
      header("Location:mantenedor_consulta_usuario.php?user=$usuario");
      echo "<script>
          window.location='mantenedor_consulta_usuario.php?user=$usuario';
        </script>";
    }else{
      header("Location:mantenedor_crea_usuario.php?user=$usuario");
      echo "<script>
          window.location='mantenedor_crea_usuario.php?user=$usuario';
        </script>";
      exit;
    }
?>

 