<?php
//Vuelve a la página proceso_carga_policonsultante.php para cargar otro archivo
if(isset($_POST['volverAProcesoCarga'])){
  header("Location:proceso_carga_policonsultante.php");
  exit;
}

//Captura el periodo a procesar
if(isset($_POST['opcionesSeleccionadas'])){
  $periodo = $_POST["periodo"];
}

//Se cargan los meses en arreglo único
if($periodo==1){
  $meses=array("Enero, Febrero y Marzo");
}else if($periodo==2){
  $meses=array("Abril, Mayo y Junio");
}else if($periodo==3){
  $meses=array("Julio, Agosto y Septiembre");
}else{
  $meses=array("Octubre, Noviembre y Diciembre");
}

//Realiza la busqueda de los rut que se repiten más de cuatro veces
include('conexion.php');
$consulta="SELECT folio, fecha_ingreso, rut_paciente, nombre_paciente, sexo, edad, tipo_edad, desc_centro_inscripcion,
        categorizacion, nombre_categoriza, causa_salida, desc_cie10, diagnostico_complementario, nombre_profesional 
FROM tabla_policonsultante
WHERE rut_paciente
IN (SELECT rut_paciente
FROM tabla_policonsultante
GROUP BY rut_paciente
HAVING count(rut_paciente) >3)
ORDER BY rut_paciente";
$ejecutar=$conexion->query($consulta);
mysqli_close($conexion);

//Proceso que genera el archivo CSV policonsultante a descargar
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename=policonsultantes.csv');
$output = fopen("php://output", "w");
$titulo=array('Folio', 'Fecha ingreso', 'rut', 'Nombre paciente', 'Sexo', 'Edad'
    , 'Tipo edad', 'Inscrito', 'Categorización', 'Nombre quien categoriza'
    , 'Estado', 'Diagnostico', 'Diagnostico complementario', 'Médico');

//Títulos de los campos
$titulo = array_map("utf8_decode", $titulo);

//Titulo de los policonsultantes
$msj=array('Policonsultante correspondiente a');

//Salto de linea
$espacio=array(' ');

//Se crean las salidas del CSV
fputcsv($output,$msj ,";");
fputcsv($output, $meses,";");
fputcsv($output, $espacio,";");
fputcsv($output, $espacio,";");
fputcsv($output, $titulo,";");

//Se recorre el arreglo de la consulta 
while ($registro = mysqli_fetch_assoc($ejecutar)){
  $registro = array_map("utf8_decode", $registro);
  //Quedan fuera los pacientes sin rut y los retiros
  if ($registro['rut_paciente']!='-' and $registro['causa_salida']=="ATENDIDO"){
    fputcsv($output, $registro,";");
  }
}
fclose($output);
?>