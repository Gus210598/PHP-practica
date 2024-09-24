<?php
  include('menu.php');
  include('conexion.php');
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
        <form class="cajaProcesoMenuGrande" enctype="multipart/form-data" action="procesar_turno.php" method="POST" onsubmit="return validaRadio()">
          <h2 class="cargaH2">Cierre de turno</h2>
          <h5 class="menuProcesoH6">Folios cargados al servidor: <?php echo $usuario_ = $_GET['carga'];?></h5>  
          
          <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-info">
            <input type="radio" name="turno" value="1" autocomplete="off"> Turno 1 08-17</label>
            <label class="btn btn-info active">
            <input type="radio" name="turno" value="2" autocomplete="off"> Turno 2 17-08</label>
          </div>
          
          <br><br>
          <input class="btnCalendario" type="date" name="fechaProcesar" id="fechaProcesar" value="<?php date_default_timezone_set('America/Santiago'); echo date('Y-m-d'); ?>" >
          <br/><br/>
          <div class="form-check">
            <input class="form-check-input-check" type="checkbox" name="adelantaFecha" id="flexCheckDefault" autocomplete="off">
            <label class="btn btn-outline-success" for="flexCheckDefault">Seleccionar día anterior</label>

            <input class="btn-check" type="checkbox" name="procesaMes" id="flexCheckChecked" autocomplete="off">
            <label class="btn btn-outline-success" for="flexCheckChecked">Procesar el mes</label>
          </div>
          <button id="botonAceptarProcesoMenu" type="submmit" name="menuListados" class="btn btn-success">Entrar a listados</button>
          </br></br>
          <button id="botonAceptarProcesoMenu" type="submmit" name="opcionesSeleccionadas" class="btn btn-success">Procesar información</button>
  
        </form>
       
      </div>
    </div>
  </div>
</body>
</html>