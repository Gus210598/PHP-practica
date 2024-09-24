<?php
    include('conexion.php');
    require('FPDF/fpdf.php');

    $fechaCerrar = $_GET["fecha"];
    
    $consulta="SELECT folio FROM archivo_csv_cargado WHERE fecha_ingreso='$fechaCerrar' ORDER BY folio ASC";    
    
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
            $this->SetTextColor(0,0,0);

            $this->Cell(0,10,utf8_decode('Correlativos'),0,1,'C');
            $this->SetFont('Times','U',12);
            //$this->Cell(60);
            $this->Cell(0,3,utf8_decode('SAR Aguas negras-Curicó'),0,0,'C');
            // Salto de línea
            $this->Ln(11);        
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
    $pdf->AddPage('PORTRAIT','letter');
    $pdf->SetFont('Times','',14);

    $faltantes=[];
    $primeraPasada=true;
    $pos=0;
    while ($correlativo = mysqli_fetch_array($ejecutar)) {
        if ($primeraPasada) {
            $inicioRango=$correlativo['folio'];
            $primeraPasada=false;
        }
        while ($correlativo['folio']>$inicioRango){
            $faltantes[$pos]=$inicioRango;
            $inicioRango++;
            $pos++;
        }
        $inicioRango++;
 
        $ultimoFolio=$correlativo['folio'];
    }

    $inicioCorrelativo=$ultimoFolio;
    $finFaltantes=sizeof($faltantes);
    $inicioFaltantes=0;
    $cuadrarFolios=0;
    $ancho=21;
    $ii=30;
    $alto=7.4;
    for ($x=1; $x<= $ii; $x++) {
        if ($inicioFaltantes<=$finFaltantes-1){
            $faltantes[$inicioFaltantes];
            $pdf->Cell($ancho,$alto,utf8_decode($faltantes[$inicioFaltantes]),1,0,'C',false);

            $inicioFaltantes++;
        }
        $cuadrarFolios++;
        $inicioCorrelativo++;
        $intermedioCorrelativo=$inicioCorrelativo;
        
        $pdf->Cell(3);
        if ($cuadrarFolios>$finFaltantes) {
            $pdf->Cell($ancho);
        }
        $pdf->Cell($ancho,$alto,utf8_decode($inicioCorrelativo),1,0,'C',false);
        for ($y=$ii; $y<= 210; $y=$y+$ii) {
            $intermedioCorrelativo=$inicioCorrelativo+$y;
            $pdf->Cell($ancho,$alto,utf8_decode($intermedioCorrelativo),1,0,'C',false);
        }
        $pdf->Cell(1,$alto,utf8_decode(''),0,1,'C',false);
    }

  $pdf->Output('Correlativos.pdf','I','utf8');

?>