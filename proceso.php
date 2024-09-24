<!doctype html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <script src="js/tarea5.js"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/general.css">

  <title>Proceso</title>


</style>
</head>
<body>


    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-dark " style="background-color: #205667;">
        <a id="claro" class="navbar">Centro médico Mi Salud</a>
        <button type="button" data-target = "#menu" data-toggle="collapse" class="navbar-toggler">
          <span class="navbar-toggler-icon"></span>
        </button>

       
      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="inicio_sesion.php">Proceso</a>
          </li>
          <li class="nav-item disabled">
            <a class="nav-link" href="">Exámenes</a>
          </li>
          <li class="nav-item desabled">
            <a class="nav-link" href="">Horas</a>
          </li>
          <li class="nav-item disabled">
            <a class="nav-link" href="">Misión</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Inicio</a>
          </li>
        </ul>
        <span class="navbar-text">Menú de opciones</span>
      </div>
      </nav>
    </div>

  <br><br>
    
     
      <?php
      include ('sesion.php');
      ?>
     <p style="text-align:center">Bienvenido <?php echo $_SESSION['nombres']?></p>
     <body bgcolor="#bed7c0">
<div class="contenido">
<h1>Subir archivo .CSV</h1>
<br>
<form enctype="multipart/form-data" action="carga_csv.php" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
   <p>Subir: <input name="subir_archivo" type="file" /></p>
   <p> <input type="submit" name ="importar_datos" value="Enviar Archivo" /></p>
</form>
</div>

      </div>
    </div>
  </div>
</body>
</html>
