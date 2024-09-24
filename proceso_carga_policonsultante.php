<?php
    include ('sesion.php');
?>
<!doctype html>
<html lang="es">
<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/general.css">
  <script src="sweetalert/sweetalert2.all.min.js"></script>
  <link href="sweetalert/sweetalert2.min.css">
  <?php
  include ('menu.php');
  if ($_SESSION['tipoUsuario']!="ADM"){
      echo "<script>
      Swal.fire({
        type: 'warning',
        title: 'Usuario no tiene acceso a los policonsultantes',
        
      }).
      then(function(result){
        if(result.value){
        window.location='inicio.php';
        }})
      </script>";
  }

?>


  <title>Proceso</title>
</head>
  
<body bgcolor="#bed7c0">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-4">
        <br>
        <form class="cajaProcesoMenuPoliconsultante" enctype="multipart/form-data" action="carga_csv_policonsultante.php" method="POST">
          <h2 class="cargaH2">Policonsultante subir archivo</h2>
          
          <input type="hidden" name="MAX_FILE_SIZE" value="912000000" />
          <p>Subir: <input name="subir_archivo" type="file" /></p>
          <p> <input class="botonAceptarCarga" type="submit" name ="importar_datos" value="Enviar y acumular" /></p>
          <p> <input class="botonAceptarCarga" type="submit" name ="borrar_acumulado" value="Borrar tabla acumulado" /></p>
          <p> <input class="botonAceptarCarga" type="submit" name ="proceso_policonsultante" value="Proceso policonsultante" /></p>
          
        </form>
      </div>
    </div>
  </div>
</body>  
</html>
