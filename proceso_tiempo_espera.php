<?php
    $fechaCerrar = $_GET["fecha"];
    $turnoProcesar = $_GET["turno"];  
    $mesProcesar = $_GET["mes"];  

    // Tiempo de espera
    $t00m_05m=0;
    $t05m_10m=0;
    $t10m_15m=0;
    $t15m_20m=0;
    $t20m_30m=0;
    $t30m_40m=0;
    $t40m_50m=0;
    $t50m_60m=0;
    $t01h00m_10m=0;
    $t01h10m_20m=0;
    $t01h20m_30m=0;
    $t01h30m_40m=0;
    $t01h40m_50m=0;
    $t01h50m_02h=0;
    $t02h_03h=0;
    $t03h_04h=0;
    $t04h_mas=0;

    include('conexion.php');
    if ($mesProcesar=='on'){
        $consulta="SELECT * FROM archivo_csv_cargado WHERE causa_salida='ATENDIDO' ";
    } else {
        $consulta="SELECT * FROM archivo_csv_cargado WHERE causa_salida='ATENDIDO' AND fecha_ingreso='$fechaCerrar' ";
    }
            
    //$consulta="SELECT * FROM archivo_csv_cargado WHERE causa_salida='ATENDIDO' ";
    
    $ejecutar=$conexion->query($consulta);
    mysqli_close($conexion);
    $cantidadRegistros = $ejecutar->num_rows;

    // Proceso
    while ($registro = mysqli_fetch_array($ejecutar)){
        // Captura de tiempos de espera
        
        $fecha_y_hora__iniciaAtencion  = new DateTime($registro['fecha_ingreso'].$registro['hora_ingreso']);
        $fecha_y_hora__finalizaAtencion= new DateTime($registro['fecha_cierre_atencion'].$registro['hora_cierre_atencion']);
        
        $tiempoEspera = $fecha_y_hora__iniciaAtencion->diff($fecha_y_hora__finalizaAtencion);
        // echo "<br>";
        // echo $tiempoEspera->format('%H horas %i minutos %s seconds');
        // echo "<br>";
        $hora    = $tiempoEspera->format('%H');
        $minutos = $tiempoEspera->format('%i');
        $segundos= $tiempoEspera->format('%s');
        
        if ($hora == 0) {
            if ($minutos >=0 & $minutos <= 4) {
                $t00m_05m++;
            } elseif ($minutos >=5 & $minutos <=9 ) { 
                $t05m_10m++;
            } elseif ($minutos >=10 & $minutos <=14 ) { 
                $t10m_15m++;
            } elseif ($minutos >=15 & $minutos <=19 ) { 
                $t15m_20m++;
            } elseif ($minutos >=20 & $minutos <=29 ) { 
                $t20m_30m++;
            } elseif ($minutos >=30 & $minutos <=39 ) { 
                $t30m_40m++;
            } elseif ($minutos >=40 & $minutos <=49 ) { 
                $t40m_50m++;
            } elseif ($minutos >=50 & $minutos <=59 ) { 
                $t50m_60m++;
            }
        } elseif ($hora == 1) {
            if ($minutos >=0 & $minutos <= 9) {
                $t01h00m_10m++;
            } elseif ($minutos >=10 & $minutos <=19 ) { 
                $t01h10m_20m++;
            } elseif ($minutos >=20 & $minutos <=29 ) { 
                $t01h20m_30m++;
            } elseif ($minutos >=30 & $minutos <=39 ) { 
                $t01h30m_40m++;
            } elseif ($minutos >=40 & $minutos <=49 ) { 
                $t01h40m_50m++;
            } elseif ($minutos >=50 & $minutos <=59 ) { 
                $t01h50m_02h++;
            }
        } elseif ($hora == 2) {
            $t02h_03h++;
        } elseif ($hora == 3) {
            $t03h_04h++;
        } elseif ($hora >= 4) {
            $t04h_mas++;
        }
    }

    // Genera el PDF

    require('FPDF/fpdf.php');
    
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

            $this->Cell(0,10,utf8_decode('Tiempos de espera '),0,1,'C');
            $this->SetFont('Times','U',12);
            //$this->Cell(60);
            $this->Cell(0,3,utf8_decode('SAR Aguas negras-Curicó'),0,0,'C');
            // Salto de línea
            $this->Ln(15);
            $this->SetTextColor(0,0,0);           
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
    $pdf->SetFont('Times','',12);

    $pdf->Ln();
    $pdf->Cell(30);
    $pdf->SetFont('Times','',11);
    $pdf->SetFont('','B',10);

    $pdf->Cell(50,5,utf8_decode('Minutos'),1,0,'C',false);
    $pdf->Cell(25,5,utf8_decode('Cantidad'),1,0,'C',false);
    $pdf->SetFont('','',10);

    $pdf->Ln();
    $pdf->Cell(30);

    $pdf->Cell(50,5,utf8_decode('00 a 05 minutos'),1,0,'F',false);
    if ($t00m_05m == 0) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t00m_05m),1,0,'C',false);
    }
    
    $pdf->Ln();
    $pdf->Cell(30);
    $pdf->Cell(50,5,utf8_decode('05 a 10 minutos'),1,0,'F',false);
    if ($t05m_10m == 0) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t05m_10m),1,0,'C',false);
    }

    $pdf->Ln();
    $pdf->Cell(30);
    $pdf->Cell(50,5,utf8_decode('10 a 15 minutos'),1,0,'',false);
    if ($t10m_15m == 0 ) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t10m_15m),1,0,'C',false);
    }

    $pdf->Ln();
    $pdf->Cell(30);
    $pdf->Cell(50,5,utf8_decode('15 a 20 minutos'),1,0,'',false);
    if ($t15m_20m == 0 ) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t15m_20m),1,0,'C',false);
    }


    $pdf->Ln();
    $pdf->Cell(30);
    $pdf->Cell(50,5,utf8_decode('20 a 30 minutos'),1,0,'',false);
    if ($t20m_30m == 0 ) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t20m_30m),1,0,'C',false);
    }
    $pdf->Ln(8);
    $pdf->Cell(30);
    $pdf->Cell(50,5,utf8_decode('30 a 40 minutos'),1,0,'',false);
    if ($t30m_40m == 0 ) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t30m_40m),1,0,'C',false);
    }
    $pdf->Ln();
    $pdf->Cell(30);

    $pdf->Cell(50,5,utf8_decode('40 a 50 minutos'),1,0,'',false);
    if ($t40m_50m == 0 ) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t40m_50m),1,0,'C',false);
    }

    $pdf->Ln();
    $pdf->Cell(30);
    $pdf->Cell(50,5,utf8_decode('50 minutos a 1 hora'),1,0,'',false);
    if ($t50m_60m == 0 ) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t50m_60m),1,0,'C',false);
    }
    $pdf->Ln(8);
    $pdf->Cell(30);
    $pdf->Cell(50,5,utf8_decode('1 hora a 1 hora con 10 minutos'),1,0,'',false);
    if ($t01h00m_10m == 0 ) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t01h00m_10m),1,0,'C',false);
    }
    $pdf->Ln();

    $pdf->Cell(30);
    $pdf->Cell(50,5,utf8_decode('1 hora 10 a 1 hora con 20 minutos'),1,0,'',false);
    if ($t01h10m_20m == 0 ) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t01h10m_20m),1,0,'C',false);
    }

    $pdf->Ln();
    $pdf->Cell(30);
    $pdf->Cell(50,5,utf8_decode('1 hora 20 a 1 hora con 30 minutos'),1,0,'',false);
    if ($t01h20m_30m == 0 ) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t01h20m_30m),1,0,'C',false);
    }

    $pdf->Ln();
    $pdf->Cell(30);

    $pdf->Cell(50,5,utf8_decode('1 hora 30 a 1 hora con 40 minutos'),1,0,'',false);
    if ($t01h30m_40m == 0 ) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t01h30m_40m),1,0,'C',false);
    }

    $pdf->Ln();
    $pdf->Cell(30);
    $pdf->Cell(50,5,utf8_decode('1 hora 40 a 1 hora con 50 minutos'),1,0,'',false);
    if ($t01h40m_50m == 0 ) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t01h40m_50m),1,0,'C',false);
    }

    $pdf->Ln();
    $pdf->Cell(30);

    $pdf->Cell(50,5,utf8_decode('1 hora 50 a 2 horas'),1,0,'',false);
    if ($t01h50m_02h == 0 ) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t01h50m_02h),1,0,'C',false);
    }

    $pdf->Ln(8);
    $pdf->Cell(30);
    $pdf->Cell(50,5,utf8_decode('2 horas a 3 horas'),1,0,'',false);
    if ($t02h_03h == 0 ) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t02h_03h),1,0,'C',false);
    }
    $pdf->Ln();
    $pdf->Cell(30);
    $pdf->Cell(50,5,utf8_decode('3 horas a 4 horas'),1,0,'',false);
    if ($t03h_04h == 0 ) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t03h_04h),1,0,'C',false);
    }
    $pdf->Ln();
    $pdf->Cell(30);
    $pdf->Cell(50,5,utf8_decode('4 horas y más'),1,0,'',false);
    if ($t04h_mas == 0 ) {
        $pdf->Cell(25,5,utf8_decode(''),1,0,'C',false);
    } else {
        $pdf->Cell(25,5,utf8_decode($t04h_mas),1,0,'C',false);
    }
    $pdf->Ln();
    $pdf->Cell(30);
    $pdf->SetFont('','B',12);
    $pdf->Cell(50,5,utf8_decode('TOTAL'),1,0,'',false);
    $pdf->Cell(25,5,utf8_decode($cantidadRegistros),1,0,'C',false);
    $pdf->SetFont('','',10);

    $pdf->Output('ListadoTiempoEspera.pdf','I','utf8');

?>




