<?php
  include('menu.php');
    $fechaCerrar = $_GET["fecha"];    
    $turno = $_GET["turno"];
    $mes = $_GET["mes"];
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
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-4">
        <br>
        <form class="cajaProcesoMenu" enctype="multipart/form-data" action="archivo_diario_pdf.php" method="POST" target="_blank" >
          <h2 class="cargaH2">Listados</h2>
          
          <input id="fechaProcesar" name="fechaProcesar" type="hidden" value="<?php echo $fechaCerrar; ?>">
          <input id="turno" name="turno" type="hidden" value="<?php echo $turno; ?>">
          <input id="turno" name="mes" type="hidden" value="<?php echo $mes; ?>">
          <button id="botonAceptarProcesoMenu" type="submmit" name="ordenadoDiagnostico" class="btn btn-success">PDF ordenado por diagnistico</button>
          <br><br>
          <button id="botonAceptarProcesoMenu" type="submmit" name="ordenadoFolio" class="btn btn-success">PDF ordenado por folio</button>
          <br><br>
          <button id="botonAceptarProcesoMenu" type="submmit" name="tiempoEspera" class="btn btn-success">PDF Tiempo de espera</button>
          <br><br>
          <button id="botonAceptarProcesoMenu" type="submmit" name="sacaCorrelativos" class="btn btn-success">PDF Correlativos</button>
          
        </form>
       
      </div>
    </div>
  </div>
</body>
</html>