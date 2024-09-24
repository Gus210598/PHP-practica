<?php
    include ('sesion.php');
?>
<!doctype html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <script src="js/validaciones.js"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/menu.css">

  <title>SAR Aguas Negras</title>
</head>
<body>
  <!--Se crea el menú principal con navbar y con la utilización de bootstrap-->
  <!-- -->
  <div class="container">
    <nav class="navbar navbar-expand-sm navbar-dark " style="background-color: #61AE87;">
      <!--<span id="claro" class="navbar">SAR Aguas Negras</span>-->
      <img id="menu" src="img/logo.jpg" class="navbar">
      <button type="button" data-target = "#menu" data-toggle="collapse" class="navbar-toggler">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="proceso_carga.php">Cierres</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="proceso_carga_policonsultante.php">Policonsultantes</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="menu_mantenedores.php">Mantenedores</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="inicio.php">Inicio</a>
          </li>
        </ul>
        <span class="navbar-text"><?php echo $_SESSION['nombres']?></span>
      </div>
    </nav>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
<footer class="bg-light text-center text-lg-start fixed-bottom">
  
  <div class="text-center p-3" style="background-color: rgba(0, 150, 100, 0.2);">
    <h6>Practica profesional Ingeniería en Informática - © 2023</h6>   
    <h6 class="text-dark">Gustavo Barahona Ilabaca</h6>
  </div>
</footer>

</html>