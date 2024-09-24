<?php
  include('menu.php');
  include('conexion.php');
  $consulta="SELECT * FROM tabla_policonsultante";
  $ejecutar=$conexion->query($consulta);
  $cantidad=mysqli_num_rows($ejecutar);
  mysqli_close($conexion);
?>

<!doctype html>
<html lang="es">
<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <script src="js/validaciones.js"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/general.css">
  <title>Proceso</title>
</head>
<body bgcolor="#bed7c0">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-4">
        <br>
        <form class="cajaProcesoMenuPoliconsultante" enctype="multipart/form-data" action="procesar_policonsultante.php" method="POST" >
          <h2 class="cargaH2">Carga de archivos</h2>
          <h5 class="menuProcesoH6">Folios cargados al servidor: <?php echo $usuario_ = $_GET['carga'];?></h5>  
          <h5 class="menuProcesoH6">Folios pasados para procesar: <?php echo $usuario_ = $_GET['pasadosBD'];?></h5>  
          <h5 class="menuProcesoH6">Acumulados a procesar: <?php echo $cantidad;?></h5>  

          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-info">
            <input type="radio" name="periodo" value="1" autocomplete="off"> Ene-Feb-Mar </label>
            <label class="btn btn-info active">
            <input type="radio" name="periodo" value="2" autocomplete="off"> Abr-May-Jun </label>
            <label class="btn btn-info active">
            <input type="radio" name="periodo" value="3" autocomplete="off"> Jul-Ago-Sep </label>
            <label class="btn btn-info active">
            <input type="radio" name="periodo" value="4" autocomplete="off"> Oct-Nov-Dic </label>
          </div>
          <button id="botonAceptarProcesoMenuPoli" type="submmit" name="opcionesSeleccionadas" class="btn btn-success">Procesar información</button>
          <br><br>

          <button id="botonAceptarProcesoMenuPoli" type="submmit" name="volverAProcesoCarga" class="btn btn-success">Cargar otro archivo</button>

        </form>
       
      </div>
    </div>
  </div>
</body>
</html>