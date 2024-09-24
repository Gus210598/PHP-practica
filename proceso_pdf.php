<?php
  include('conexion.php');
  // include('conexion.php');
  $retiros="SELECT * FROM archivo_csv_cargado WHERE causa_salida<>'ATENDIDO' ";
  $ejecutar=$conexion->query($retiros);
  mysqli_close($conexion);
  $cantidadRetiros = $ejecutar->num_rows;

  // echo "retiros $cantidadRetiros      mmmmmm";

  require('FPDF/fpdf.php');

  //Traspaso de variables del formulario anteior
  if(isset($_POST['datosPDF'])){
      
    //SDA
    $d0a4 = $_POST["d0a4"];
    $d5a9 = $_POST["d5a9"];
    $d10a14 = $_POST["d10a14"];
    $d15a19 = $_POST["d15a19"];
    $d20a24 = $_POST["d20a24"];
    $d25a29 = $_POST["d25a29"];
    $d30aSUP = $_POST["d30aSUP"];
   
    //Categorización
    $C1M = $_POST["C1M"];
    $C1F = $_POST["C1F"];
    $C2M = $_POST["C2M"];
    $C2F = $_POST["C2F"];
    $C3M = $_POST["C3M"];
    $C3F = $_POST["C3F"];
    $C4M = $_POST["C4M"];
    $C4F = $_POST["C4F"];
    $C5M = $_POST["C5M"];
    $C5F = $_POST["C5F"];

    // Retiros
    //$cantidadRetiros = $_POST["cantidadRetiros"];

    //Médicos y cantidad atendido por médico
    session_start();
    $nombreMedico=$_SESSION['nombreMedico'];
    $pacientesAtendidosMedicos=$_SESSION['pacientesAtendidosMedicos'];

    //Sectores
    $sectoresLugares=$_SESSION['sectoresLugares'];
    $cantidadSectoresLugares=$_SESSION['cantidadSectoresLugares'];

    //Covid
    $c19Sospecha = $_POST["c19Sospecha"];
    $c19Positivo = $_POST["c19Positivo"];

    
    //Varicelas
    $varicelasMenor15 = $_POST["varicelasMenor15"];
    $varicelasMayor15 = $_POST["varicelasMayor15"];

    //Gripes
    $gripes = $_POST["gripes"];

    //Administrativo, fecha y turno quien cierra
    $admCierra = $_POST["admCierra"];
    $fechaCerrar = $_POST["fechaCerrar"];
    $turnoCerrar = $_POST["turnoCerrar"];

    //Cantidad otras consultas
    $cantidadRegistros = $_POST["cantidadRegistros"];

    //Constatacion y alcoholemias
    $constatacion = $_POST["constatacion"];
    $constAlcoholemias = $_POST["constAlcoholemias"];
  }



  class PDF extends FPDF
  {
  // Cabecera de página
    function Header()
    {
      
      $this->SetFont('Arial','B',15);
      // Movernos a la derecha
      //$this->Cell(65);
      // Título
      $this->Cell(0,10,utf8_decode('Cierre estadistica por turno'),0,1,'C');
      $this->SetFont('Times','U',12);
      //$this->Cell(60);
      $this->Cell(0,3,utf8_decode('SAR Aguas negras-Curicó'),0,0,'C');
      // Salto de línea
      $this->Ln(15);
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

  $lineaAdeministrativo='Administrativo: '.$admCierra;
  $fechaCerrar = date("d-m-Y", strtotime($fechaCerrar));
  $lineaFechaCerrar='fecha: '.$fechaCerrar;
  $lineaTurnoCerrar='Turno: '.$turnoCerrar;

  // Creación del objeto de la clase heredada
  $pdf = new PDF();
  $pdf->AliasNbPages();
  $pdf->AddPage('PORTRAIT','letter');
  $pdf->SetFont('Times','',12);

  $pdf->Cell(130,6,utf8_decode($lineaAdeministrativo),1,0,'',false);
  $pdf->SetFont('Times','',12);
  $pdf->Cell(38,6,utf8_decode($lineaFechaCerrar),1,0,'',false);
  $pdf->Cell(28,6,utf8_decode($lineaTurnoCerrar),1,1,'',false);

  $pdf->Ln();
  $pdf->Cell(3);
  $pdf->SetFont('Times','',10);
  $pdf->Cell(48,5,utf8_decode('Categorización'),1,0,'C',false);
  $pdf->Cell(6);
  $pdf->Cell(25,5,utf8_decode('Varicelas'),1,0,'C',false);
  $pdf->Cell(6);
  $pdf->Cell(25,5,utf8_decode('SDA'),1,0,'C',false);
  $pdf->Cell(6);
  $pdf->Cell(25,5,utf8_decode('Covid positivos'),1,0,'C',false);
  $pdf->Cell(27,5,utf8_decode('Sospechas Covid'),1,0,'C',false);
  
  $pdf->Ln();
  $pdf->Cell(11);
  $pdf->Cell(20,5,utf8_decode('Hombres'),1,0,'C',false);
  $pdf->Cell(20,5,utf8_decode('Mujeres'),1,0,'C',false);
  $pdf->Cell(6);
  $pdf->Cell(15,5,utf8_decode('Menor 15'),1,0,'C',false);
  $pdf->Cell(10,5,utf8_decode($varicelasMenor15),1,0,'C',false);
  $pdf->Cell(6);
  $pdf->Cell(12,5,utf8_decode('0-4'),1,0,'',false);
  $pdf->Cell(13,5,utf8_decode($d0a4),1,0,'C',false);
  $pdf->Cell(6);
  $pdf->Cell(25,5,utf8_decode($c19Positivo),1,0,'C',false);
  $pdf->Cell(27,5,utf8_decode($c19Sospecha),1,1,'C',false);
  
  $pdf->Cell(3);
  $pdf->Cell(8,5,utf8_decode('C1'),1,0,'C',false);
  $pdf->Cell(20,5,utf8_decode($C1M),1,0,'C',false);
  $pdf->Cell(20,5,utf8_decode($C1F),1,0,'C',false);
  $pdf->Cell(6);
  $pdf->Cell(15,5,utf8_decode('Mayor 15'),1,0,'C',false);
  $pdf->Cell(10,5,utf8_decode($varicelasMayor15),1,0,'C',false);
  $pdf->Cell(6);
  $pdf->Cell(12,5,utf8_decode('5-9'),1,0,'',false);
  $pdf->Cell(13,5,utf8_decode($d5a9),1,1,'C',false);
  
  $pdf->Cell(3);
  $pdf->Cell(8,5,utf8_decode('C2'),1,0,'C',false);
  $pdf->Cell(20,5,utf8_decode($C2M),1,0,'C',false);
  $pdf->Cell(20,5,utf8_decode($C2F),1,0,'C',false);
  $pdf->Cell(37); 
  $pdf->Cell(12,5,utf8_decode('10-14'),1,0,'',false);
  $pdf->Cell(13,5,utf8_decode($d10a14),1,1,'C',false);

  $pdf->Cell(3);
  $pdf->Cell(8,5,utf8_decode('C3'),1,0,'C',false);
  $pdf->Cell(20,5,utf8_decode($C3M),1,0,'C',false);
  $pdf->Cell(20,5,utf8_decode($C3F),1,0,'C',false);
  $pdf->Cell(6);
  $pdf->Cell(12,5,utf8_decode('Gripes'),1,0,'',false);
  $pdf->Cell(13,5,utf8_decode($gripes),1,0,'C',false);
  $pdf->Cell(6);
  $pdf->Cell(12,5,utf8_decode('15-19'),1,0,'',false);
  $pdf->Cell(13,5,utf8_decode($d15a19),1,1,'C',false);
  
  $pdf->Cell(3);
  $pdf->Cell(8,5,utf8_decode('C4'),1,0,'C',false);
  $pdf->Cell(20,5,utf8_decode($C4M),1,0,'C',false);
  $pdf->Cell(20,5,utf8_decode($C4F),1,0,'C',false);
  $pdf->Cell(37);
  $pdf->Cell(12,5,utf8_decode('20-24'),1,0,'',false);
  $pdf->Cell(13,5,utf8_decode($d20a24),1,1,'C',false);

  $pdf->Cell(3);
  $pdf->Cell(8,5,utf8_decode('C5'),1,0,'C',false);
  $pdf->Cell(20,5,utf8_decode($C5M),1,0,'C',false);
  $pdf->Cell(20,5,utf8_decode($C5F),1,0,'C',false);
  $pdf->Cell(37);
  $pdf->Cell(12,5,utf8_decode('25-29'),1,0,'',false);
  $pdf->Cell(13,5,utf8_decode($d25a29),1,1,'C',false);
  
  $pdf->SetFillColor(200,200,200);
  $pdf->Cell(3);
  $pdf->SetFont('Times','',9);
  $pdf->Cell(8,5,utf8_decode('Total'),1,0,'C',1);
  $pdf->SetFont('Times','',10);
  $totCatMasculino=$C1M+$C2M+$C3M+$C4M+$C5M;
  $totCatFemenino=$C1F+$C2F+$C3F+$C4F+$C5F;
  $pdf->Cell(20,5,utf8_decode($totCatMasculino),1,0,'C',1);
  $pdf->Cell(20,5,utf8_decode($totCatFemenino),1,0,'C',1);
  $pdf->SetFillColor(255,255,255);
  
  $totSDA=$d0a4+$d5a9+$d10a14+$d15a19+$d20a24+$d25a29+$d30aSUP;
  $pdf->Cell(37);
  $pdf->Cell(12,5,utf8_decode('30 más'),1,0,'',false);
  $pdf->Cell(13,5,utf8_decode($d30aSUP),1,1,'C',false);
  
  $pdf->Cell(88);
  $pdf->SetFillColor(200,200,200);
  $pdf->Cell(12,5,utf8_decode('Total'),1,0,'',1);
  $pdf->Cell(13,5,utf8_decode($totSDA),1,0,'C',1);
  $pdf->SetFillColor(255,255,255);
  
  $pdf->Ln();
  $pdf->Cell(3);
  $pdf->Cell(40,5,utf8_decode('Total otras consultas '),1,0,'',1);
  $pdf->Cell(13,5,utf8_decode($cantidadRegistros),1,1,'C',1);
  
  $pdf->Cell(3);
  $pdf->Cell(40,5,utf8_decode('Total varicelas '),1,0,'',1);
  $totVaricelas=$varicelasMenor15+$varicelasMayor15;
  $pdf->Cell(13,5,utf8_decode($totVaricelas),1,0,'C',1);
  $pdf->Cell(6);
  $pdf->Cell(42,5,utf8_decode('Constatación de lesiones'),1,0,'',false);
  $pdf->Cell(13,5,utf8_decode($constatacion),1,1,'C',false);
  
  $pdf->Cell(3);
  $totCovid=$c19Sospecha+$c19Positivo;
  $pdf->Cell(40,5,utf8_decode('Total covid (Sos+Pos)'),1,0,'',1);
  $pdf->Cell(13,5,utf8_decode($totCovid),1,0,'C',1);
  $pdf->Cell(6);
  $pdf->Cell(42,5,utf8_decode('Constatación + alcoholemia'),1,0,'',false);
  $pdf->Cell(13,5,utf8_decode($constAlcoholemias),1,1,'C',false);

  $pdf->Cell(3);
  $totCovid=$c19Sospecha+$c19Positivo;
  $pdf->Cell(40,5,utf8_decode('Total constataciones'),1,0,'',1);
  $pdf->Cell(13,5,utf8_decode($constatacion),1,0,'C',1);
  $pdf->Cell(6);
  $pdf->Cell(42,5,utf8_decode('Retiros'),1,0,'',1);
  $pdf->Cell(13,5,utf8_decode($cantidadRetiros),1,1,'C',1);
  
  $pdf->Cell(3);
  $pdf->SetFillColor(200,200,200);
  $totAtendidos=$totCovid+$totVaricelas+$cantidadRegistros+$constatacion+$constAlcoholemias;
  $pdf->Cell(40,5,utf8_decode('Total atendidos'),1,0,'',1);
  $pdf->Cell(13,5,utf8_decode($totAtendidos),1,0,'C',1);
  $pdf->SetFillColor(255,255,255);

  $pdf->Ln(12);
  $pdf->Cell(3);
  $pdf->SetLineWidth(1);
  $pdf->Cell(60,5,utf8_decode('Médicos'),'T',0,'C',0);
  $pdf->Cell(45,5,utf8_decode('Atendidos'),'T',0,'C',0);
  $totalMedicos=0;
  for ($x=0;$x<count($nombreMedico);$x++){
    if ($x % 2 == 0){
      $pdf->SetFillColor(200,200,200);
    }else{
      $pdf->SetFillColor(255,255,255);
    }
    $pdf->Ln();
    $pdf->Cell(3);
    $totalMedicos=$totalMedicos+$pacientesAtendidosMedicos[$x];
    $pdf->Cell(80,5,utf8_decode($nombreMedico[$x]),0,0,'L',1);
    $pdf->Cell(25,5,utf8_decode($pacientesAtendidosMedicos[$x]),0,0,'L',1);
  }
  $pdf->Ln();
  $pdf->Cell(3);
  $pdf->SetLineWidth(1);
  $pdf->Cell(60,5,utf8_decode('Total atendido'),'T',0,'L',1);
  $pdf->Cell(45,5,utf8_decode($totalMedicos),'T',0,'C',1);

  $pdf->Ln(12);
  $pdf->Cell(3);
  $pdf->Cell(85,5,utf8_decode('Sectores'),'T',0,'C',0);
  $pdf->Cell(55,5,utf8_decode('Cantidad'),'T',0,'C',0);

  for ($x=0;$x<count($sectoresLugares);$x++){
    if ($x % 2 == 0){
      $pdf->SetFillColor(200,200,200);
    }else{
      $pdf->SetFillColor(255,255,255);
    }
    $pdf->Ln();
    $pdf->Cell(3);
    $pdf->Cell(110,5,utf8_decode($sectoresLugares[$x]),0,0,'L',1);
    $pdf->Cell(0.1);
    $pdf->Cell(30,5,utf8_decode($cantidadSectoresLugares[$x]),0,0,'L',1);

  }
  
$pdf->Output('cierreProceso.pdf','I','utf8');
?>