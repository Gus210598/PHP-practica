<!doctype html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <script src="js/validaciones.js"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/iniciar.css">
  <title>SAR Aguas Negras</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-4">
        <!--Se crea el formulario que permite la entrada de datos-->
        <form name="formularioIngreso" class="cajaInicio" action="validar.php" method="post" onsubmit="return validaFormularioCampos()">
          <h2 class="cajaTitulo" scope="row">Ingrese usuario</h2>  
          <br>     
          <label class="etiquetaInicio">Usuario</label>
          <input class="inicioEntrada" type="text" id="usuario" name="usuario" size="10" placeholder='Nombre usuario' onkeyup="mayusculas(this);" required>
          <label class="etiquetaInicio">Clave</label>
          <input class="inicioEntrada" type="password" id="clave" name="clave" size="10" placeholder='*******' required>
          <br><br>
          <button name="aceptarFormulario" id="boton1" type="submit" class="botonAceptar">Aceptar</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>



