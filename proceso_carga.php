<?php
    include ('menu.php');
?>
<!doctype html>
<html lang="es">
<head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
        <form class="cajaProceso" enctype="multipart/form-data" action="carga_csv.php" method="POST">
          <h2 class="cargaH2">Subir archivo .CSV</h2>
          
          <input type="hidden" name="MAX_FILE_SIZE" value="912000000" />
          <p>Subir: <input name="subir_archivo" type="file" /></p>
          <p> <input class="botonAceptarCarga" type="submit" name ="importar_datos" value="Enviar Archivo" /></p>

        </form>
      </div>
    </div>
  </div>
</body>
</html>
