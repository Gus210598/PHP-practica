<?php
if(isset($_POST['generaCSV'])){
    header("Location:archivo_diario_csv.php");
    exit;
}
if(isset($_POST['tiempoEspera'])){
    // header("Location:archivo_tiempo_espera.php");
    $fechaCerrar = $_POST["fechaProcesar"];
    $turno = $_POST["turno"];
    $procesaMes = $_POST["mes"];

    header("Location:proceso_tiempo_espera.php?fecha=$fechaCerrar&turno=$turno&mes=$procesaMes");
    exit;
}

if(isset($_POST['sacaCorrelativos'])){
    $fechaCerrar = $_POST["fechaProcesar"];
    header("Location:archivo_correlativos.php?fecha=$fechaCerrar");
    exit;
  }

include('conexion.php');

require('FPDF/fpdf.php');


if(isset($_POST['ordenadoDiagnostico'])){
    $ordenado='Ordedano por:  Diagnóstico';
    $fechaCerrar = $_POST["fechaProcesar"];
    $procesaMes = $_POST["mes"];
    if ($procesaMes=='on'){
        $consulta="SELECT folio, fecha_ingreso, sexo, edad, tipo_edad, categorizacion, desc_cie10, diagnostico_complementario 
        FROM archivo_csv_cargado
        WHERE causa_salida = 'ATENDIDO'
        ORDER BY desc_cie10 ASC
            ";        
    } else {
        $consulta="SELECT folio, fecha_ingreso, sexo, edad, tipo_edad, categorizacion, desc_cie10, diagnostico_complementario 
        FROM archivo_csv_cargado
        WHERE causa_salida = 'ATENDIDO' AND fecha_ingreso='$fechaCerrar'
        ORDER BY desc_cie10 ASC
            ";
    }
  }
if(isset($_POST['ordenadoFolio'])){
    $ordenado='Ordedano por:  Folio';
    $fechaCerrar = $_POST["fechaProcesar"];
    $procesaMes = $_POST["mes"];
    if ($procesaMes=='on'){
        $consulta="SELECT folio, fecha_ingreso, sexo, edad, tipo_edad, categorizacion, desc_cie10, diagnostico_complementario 
        FROM archivo_csv_cargado
        WHERE causa_salida = 'ATENDIDO'
        ORDER BY folio ASC
            ";    
    } else {
        $consulta="SELECT folio, fecha_ingreso, sexo, edad, tipo_edad, categorizacion, desc_cie10, diagnostico_complementario 
        FROM archivo_csv_cargado
        WHERE causa_salida = 'ATENDIDO' AND fecha_ingreso='$fechaCerrar'
        ORDER BY folio ASC
            ";
    }

}
  $ejecutar=$conexion->query($consulta);
  mysqli_close($conexion);


class PDF extends FPDF
    {
    // Cabecera de página
    function Header()
    {
      
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        //$this->Cell(65);
        // Título
        $this->SetTextColor(16,87,97);

        $this->Cell(0,10,utf8_decode('Pacientes atendidos'),0,1,'C');
        $this->SetFont('Times','U',12);
        //$this->Cell(60);
        $this->Cell(0,3,utf8_decode('SAR Aguas negras-Curicó'),0,0,'C');
        // Salto de línea
        $this->Ln(11);

        $this->Cell(10);
        $this->SetFont('Times','B',13);
        $this->Cell(3,5,utf8_decode('Folio'),0,0,'C',false);
        $this->Cell(30,5,utf8_decode('F.Ingreso'),0,0,'C',false);
        $this->Cell(3,5,utf8_decode('Sexo'),0,0,'C',false);
        $this->Cell(19,5,utf8_decode('Edad'),0,0,'C',false);
        $this->Cell(5,5,utf8_decode('T.E'),0,0,'C',false);
        $this->Cell(19,5,utf8_decode('Cat.'),0,0,'C',false);
        $this->Cell(52,5,utf8_decode('Diagnostico'),0,0,'C',false);
        $this->Cell(190,5,utf8_decode('Diagnostico complementario'),0,0,'C',false);
        
        $this->SetDrawColor(61,174,233);
        $this->SetLineWidth(1);
        $this->Line(8,37,275,37);
        $this->SetTextColor(0,0,0);
        
        $this->SetFont('Times','',9);
        $this->SetLineWidth(0.2);
        $this->SetFillColor(240,240,240);
        $this->SetTextColor(40,40,40);
        $this->SetDrawColor(255,255,255);
        $this->Ln(8);
        
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Times','I',8);
        // Número de página
        $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('LANDSCAPE','letter');
$pdf->SetFont('Times','',12);

//$pdf->Ln();

$pdf->SetFont('Times','',9);
$pdf->SetLineWidth(0.2);
$pdf->SetFillColor(240,240,240);
$pdf->SetTextColor(40,40,40);
$pdf->SetDrawColor(255,255,255);
//$pdf->Ln(8);


$pdf->Cell(40,5,utf8_decode($ordenado),1,1,'L',1);
$correlativo=0;

//Se recorre el arreglo de la consulta 
while ($registro = mysqli_fetch_assoc($ejecutar)){
    //$registro = array_map("utf8_decode", $registro);
    $correlativo++;
    
    $fechaIngreso = date("d-m-Y", strtotime($registro['fecha_ingreso']));
    $pdf->SetFont('','',7);
    $pdf->Cell(4,5,utf8_decode($correlativo),1,0,'C',1);
    $pdf->SetFont('','',9);
    $pdf->Cell(15,5,utf8_decode($registro['folio']),1,0,'C',1);
    $pdf->Cell(17,5,utf8_decode($fechaIngreso),1,0,'C',1);
    $pdf->Cell(13,5,utf8_decode($registro['sexo']),1,0,'C',1);
    $pdf->Cell(9,5,utf8_decode($registro['edad']),1,0,'C',1);
    if ($registro['tipo_edad']=='A'){
        $pdf->Cell(14,5,utf8_decode($registro['tipo_edad']),1,0,'C',1);    
    }else{
        $pdf->SetFont('','B',9);
        $pdf->Cell(14,5,utf8_decode($registro['tipo_edad']),1,0,'C',1);
        $pdf->SetFont('','',9);
    }
    $diagnosticoComplementario = substr($registro['diagnostico_complementario'],0,41);
    $pdf->Cell(10,5,utf8_decode($registro['categorizacion']),1,0,'C',1);
    $pdf->Cell(124,5,utf8_decode($registro['desc_cie10']),1,0,'L',1);
    $pdf->Cell(60,5,utf8_decode($diagnosticoComplementario),1,0,'L',1);
    $pdf->Ln();
    

}
//$pdf->AddPage();

//fclose($output);
$pdf->Output('ListadoPacientes.pdf','I','utf8');

?>