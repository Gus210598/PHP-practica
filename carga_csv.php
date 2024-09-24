<!doctype html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <script src="sweetalert/sweetalert2.all.min.js"></script>
  <link href="sweetalert/sweetalert2.min.css">
 </head>
<body>
<?php

include ('menu.php');
include ('conexion.php');

if(isset($_POST['importar_datos'])){
    // Pasa archivos csv a la base de datos archivo_csv_cargado
    $consulta = "DELETE FROM archivo_csv_cargado";
    $ejecutar=$conexion->query($consulta);
    $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    if ($_FILES['subir_archivo']['error']==4){
        
        echo "<script>
        Swal.fire({
            type: 'warning',
            title: 'No ha seleccionado ningún archivo',
            
          }).
        then(function(result){
          if(result.value){
          window.location='proceso_carga.php';
          }})
        </script>";
    }

    if(!empty($_FILES['subir_archivo']['tmp_name']) && in_array($_FILES['subir_archivo']['type'],$file_mimes)){
        if(is_uploaded_file($_FILES['subir_archivo']['tmp_name'])){
            $archivo_csv = fopen($_FILES['subir_archivo']['tmp_name'], 'r');
            
            $descontarCabecera=1;
            
            while(($campo = fgetcsv($archivo_csv,50000,";")) !== FALSE){
                // echo "<script>console.log('Console: ' );</script>";
                //Se elimina comilla simple en campo dirección
                $campo[17]= preg_replace('/\'/', '', $campo[17]);
                $campo = array_map("utf8_encode", $campo);
                // if($descontarCabecera>6 && $campo[1]!=0 && $campo[66]=="ATENDIDO") {
                if($descontarCabecera>6 && $campo[1]!=0) {
                    $campo[2]=invertirFecha($campo[2]);
                    $campo[40]=invertirFecha($campo[40]);
                    $campo[58]=invertirFecha($campo[58]);

                    if ($campo[21]==106 or $campo[21]==124 or $campo[21]==124 ){
                        $campo[68]=$campo[22];
                    }
                    if ($campo[66]=='NO RESPONDE LLAMADO EN SDDA'){
                        
                        $campo[39]='-';
                        $campo[40]=date("Y-m-d", strtotime("1990-10-10"));
                        $campo[58]=date("Y-m-d", strtotime("1990-10-10"));
            
                    }
                    if ($campo[74]=='') {
    
                        $campo[74]=0;
                    }
                    // $consulta = "INSERT INTO archivo_csv_cargado (servicio_urgencia, folio, fecha_ingreso, hora_ingreso, nombre_adm_ingreso, rut_paciente, 
                    //                         nombre_paciente, sexo, edad, tipo_edad, nombre_prevision, grupo_fonasa, paciente_prais, 
                    //                         domicilio, comuna, cod_centro_inscripcion, desc_centro_inscripcion, cod_consulta, motivo_consulta, otro_motivo_consulta,
                    //                         codigo_medio_llegada, desc_medio_llegada, categorizacion, fecha_ini_cat, hora_ini_cat, nombre_categoriza, fecha_cierre_atencion,
                    //                         hora_cierre_atencion, causa_salida, cie10, desc_cie10, diagnostico_complementario, rut_profesional, nombre_profesional,
                    //                         tipo_profesional, alcoholemia, nro_frasco_alcoholemia, destino)
                    //     VALUES('".$campo[0]."', '".$campo[1]."', '".$campo[2]."','".$campo[3]."','".$campo[5]."','".$campo[8]."'
                    //          ,'".$campo[9]."','".$campo[10]."','".$campo[11]."','".$campo[12]."','".$campo[14]."','".$campo[15]."','".$campo[16]."'
                    //          ,'".$campo[17]."','".$campo[18]."','".$campo[19]."','".$campo[20]."','".$campo[21]."','".$campo[22]."','".$campo[23]."'
                    //          ,'".$campo[27]."','".$campo[28]."','".$campo[39]."','".$campo[40]."','".$campo[41]."','".$campo[44]."','".$campo[58]."'
                    //          ,'".$campo[59]."','".$campo[66]."','".$campo[67]."','".substr($campo[68],0,98)."','".$campo[69]."','".$campo[70]."','".$campo[71]."'
                    //          ,'".$campo[72]."','".$campo[73]."','".$campo[74]."','".$campo[79]."')";
                    //         // ,'".$campo[72]."','".$campo[73]."','".$campo[74]."','".$campo[79]."')";
                    
                    $consulta = "INSERT INTO archivo_csv_cargado (servicio_urgencia, folio, fecha_ingreso, hora_ingreso, nombre_adm_ingreso,
                            rut_paciente, nombre_paciente, sexo, edad, tipo_edad, nombre_prevision, grupo_fonasa, paciente_prais, domicilio,
                            comuna, cod_centro_inscripcion, desc_centro_inscripcion, cod_consulta, motivo_consulta, otro_motivo_consulta,
                            codigo_medio_llegada, desc_medio_llegada, categorizacion, fecha_ini_cat, hora_ini_cat, nombre_categoriza,
                            fecha_cierre_atencion, hora_cierre_atencion, causa_salida,
                            cie10, desc_cie10, diagnostico_complementario, rut_profesional, nombre_profesional, tipo_profesional,
                            alcoholemia, nro_frasco_alcoholemia, destino)
                        VALUES('".$campo[0]."', '".$campo[1]."', '".$campo[2]."','".$campo[3]."','".$campo[5]."','".$campo[8]."'
                            ,'".$campo[9]."','".$campo[10]."','".$campo[11]."','".$campo[12]."','".$campo[14]."','".$campo[15]."','".$campo[16]."'
                            ,'".$campo[17]."','".$campo[18]."','".$campo[19]."','".$campo[20]."','".$campo[21]."','".$campo[22]."','".$campo[23]."'
                            ,'".$campo[27]."','".$campo[28]."','".$campo[39]."','".$campo[40]."','".$campo[41]."','".$campo[44]."','".$campo[58]."'
                            ,'".$campo[59]."','".$campo[66]."','".$campo[67]."','".substr($campo[68],0,98)."','".substr($campo[69],0,118)."','".$campo[70]."','".$campo[71]."'
                            ,'".$campo[72]."','".$campo[73]."','".$campo[74]."','".$campo[79]."')";



                            // echo "Folio $campo[1] Es atendido === $campo[66] </br>";
                            // echo "Largo ".strlen($campo[68])."</br>";
                            // wait;
                            $ejecutar=$conexion->query($consulta);
                }
                $descontarCabecera++;
            }       
            fclose($archivo_csv);
            
            mysqli_close($conexion);
            //wair;
            $descontarCabecera=$descontarCabecera-10;
            // echo "<br>";
            // echo $contRegistros;
            // header("Location:menu_proceso.php?carga=$descontarCabecera");
            // exit;
            echo "<script>
              window.location='menu_proceso.php?carga=$descontarCabecera';
            </script>";
        } else {
            $import_status = '?import_status=error';
        }
    } else {
        $import_status = '?import_status=invalid_file';
    }
}
?>

</body>
</html>

<?php
function invertirFecha($fechaACambiar){
    $dia=substr($fechaACambiar,0,2);
    
    $mes=substr($fechaACambiar,3,2);
    
    $agno=substr($fechaACambiar,6,4);
    
    return $agno.'-'.$mes.'-'.$dia;
}
?>


