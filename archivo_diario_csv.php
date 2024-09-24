<?php

include('conexion.php');
  $consulta="SELECT folio, fecha_ingreso, sexo, edad, tipo_edad, categorizacion, desc_cie10, diagnostico_complementario, nombre_profesional
            FROM archivo_csv_cargado
            WHERE causa_salida = 'ATENDIDO'
            ORDER BY folio ASC
            ";
  $ejecutar=$conexion->query($consulta);
  mysqli_close($conexion);

//Proceso que genera el archivo CSV policonsultante a descargar

header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename=procesados.csv');
$output = fopen("php://output", "w");

$nombreCampos=array('Folio','F Ing.', 'Sx', 'Ed', 'TE', 'Cat', 'Diagnostico', 'Diagnostico complementario'. 'Médico');

//Títulos de los campos
$nombreCampos = array_map("utf8_decode", $nombreCampos);

//Título del archivo
$titulo=array('Archivo CSV para imprimir');

//Salto de linea
$espacio=array(' ');

//Se crean las salidas del CSV
fputcsv($output,$titulo,";");
fputcsv($output, $espacio,";");
fputcsv($output, $espacio,";");
fputcsv($output, $nombreCampos,";");

//Categorización por sexo
$C1F=0;
$C1M=0;
$C2F=0;
$C2M=0;
$C3F=0;
$C3M=0;
$C4F=0;
$C4M=0;
$C5F=0;
$C5M=0;

//Se recorre el arreglo de la consulta 
while ($registro = mysqli_fetch_assoc($ejecutar)){

$registro = array_map("utf8_decode", $registro);

    if ($registro['categorizacion']=='C1' and $registro['sexo']=='F'){
        $C1F++;
    }elseif ($registro['categorizacion']=='C1' and $registro['sexo']=='M'){
        $C1M++;
    }elseif ($registro['categorizacion']=='C2' and $registro['sexo']=='F'){
        $C2F++;
    }elseif ($registro['categorizacion']=='C2' and $registro['sexo']=='M'){
        $C2M++;
    }elseif ($registro['categorizacion']=='C3' and $registro['sexo']=='F'){
        $C3F++;
    }elseif ($registro['categorizacion']=='C3' and $registro['sexo']=='M'){
        $C3M++;
    }elseif ($registro['categorizacion']=='C4' and $registro['sexo']=='F'){
        $C4F++;
    }elseif ($registro['categorizacion']=='C4' and $registro['sexo']=='M'){
        $C4M++;
    }elseif ($registro['categorizacion']=='C5' and $registro['sexo']=='F'){
        $C5F++;
    }elseif ($registro['categorizacion']=='C5' and $registro['sexo']=='M'){
        $C5M++;
    }

    fputcsv($output, $registro,";");

}

  
  
$tSexo=array(' ','M','F');
$tC1=array('C1',$C1M,$C1F);
$tC2=array('C2',$C2M,$C2F);
$tC3=array('C3',$C3M,$C3F);
$tC4=array('C4',$C4M,$C4F);
$tC5=array('C5',$C5M,$C5F);

fputcsv($output, $espacio,";");
fputcsv($output, $espacio,";");  

fputcsv($output, $tSexo,";");
fputcsv($output, $tC1,";");
fputcsv($output, $tC2,";");
fputcsv($output, $tC3,";");
fputcsv($output, $tC4,";");
fputcsv($output, $tC5,";");


fclose($output);
?>