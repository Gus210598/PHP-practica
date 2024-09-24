<?php
//Carga proceso genera CSV 

  if(isset($_POST['menuListados'])){
    $turnoCerrar = $_POST["turno"];
    $diaAnterior = $_POST["adelantaFecha"];
    $fechaCerrar = $_POST["fechaProcesar"];
    $procesaMes = $_POST["procesaMes"];

    if ($diaAnterior=='on'){
      $fechaCerrar=strtotime("-1 day", strtotime($fechaCerrar));
      $fechaCerrar=date('Y-m-d', $fechaCerrar);
    }
    header("Location:menu_listados.php?fecha=$fechaCerrar&turno=$turnoCerrar&mes=$procesaMes");
    exit;
  }

  include('menu.php');
  //$fechaCierre=date('d-m-y');
  if(isset($_POST['opcionesSeleccionadas'])){
    $turnoCerrar = $_POST["turno"];
    $diaAnterior = $_POST["adelantaFecha"];
    $fechaCerrar = $_POST["fechaProcesar"];
    $procesaMes = $_POST["procesaMes"];
    if ($diaAnterior=='on'){
      $fechaCerrar=strtotime("-1 day", strtotime($fechaCerrar));
      $fechaCerrar=date('Y-m-d', $fechaCerrar);
    }
    
  }
  $fechaCerrar = date("d-m-Y", strtotime($fechaCerrar));
    
  
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/general.css">
  <title>Proceso</title>
</head>
<body bgcolor="#bed7c0">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-4">
        <br>
        <form class="cajaProcesoMenu" enctype="multipart/form-data" action="proceso_pdf.php" method="POST" target="_blank">
          <h4 class="cargaH22">Cerrando Turno <?php echo $turnoCerrar?> con fecha ingresada <?php echo $fechaCerrar?></h4>
          <br><br>
          <p class="pMensajes">- Recuerde, obtener los retiros desde sismaule (Control de atenciones)</p>
          <p class="pMensajes">- Los pacientes creados se toman como no inscritos</p>

          <?php 
          
            //Proceso de SDA
            $d0a4=0;
            $d5a9=0;
            $d10a14=0;
            $d15a19=0;
            $d20a24=0;
            $d25a29=0;
            $d30aSUP=0;

            $fechaCerrar = date("Y-m-d", strtotime($fechaCerrar));
        
                
            // Categorización
            $C1M=0; // C1 hombre
            $C1F=0; // C1 mujer
            $C2M=0;
            $C2F=0;
            $C3M=0;
            $C3F=0;
            $C4M=0;
            $C4F=0;
            $C5M=0;
            $C5F=0;
            
            //Arreglo nombre del médico
            $nombreMedico=[];
            
            //Arreglo pacientes atendido por cada médico
            $pacientesAtendidosMedicos=[];
        
            //Sospecha c19 y c19 positivos
            $c19Sospecha=0;
            $c19Positivo=0;
        
            //Arreglo que obtiene todos los sectores
            $sectoresLugares=[];
            $cantidadSectoresLugares=[];
        
            //Sectores salidas
            $central=0;
            $colon=0;
            $solDeSeptiembre=0;
            $sarmiento=0;
            $losNiches=0;
            $rauco=0;
            $romeral=0;
            $teno=0;
            $molina=0;
            $sagradaFamilia=0;
            $hualane=0;
            $licanten=0;
            $vichuquen=0;
            $noInscritos=0;
        
            //Varicelas
            $varicelasMenor15=0;
            $varicelasMayor15=0;
        
            //Constatación de lesiones y alcoholemias
            $constatacion=0;
            $constAlcoholemias=0;
        
            //Gripes
            $gripes=0;
                       
            //Comenzamos
            include('conexion.php');
            if ($procesaMes=='on'){
              $consulta="SELECT * FROM archivo_csv_cargado WHERE causa_salida='ATENDIDO' ";
            } else {
              $consulta="SELECT * FROM archivo_csv_cargado WHERE causa_salida='ATENDIDO' AND fecha_ingreso='$fechaCerrar' ";
            }
            
            $ejecutar=$conexion->query($consulta);
            mysqli_close($conexion);
            $cantidadRegistros = $ejecutar->num_rows;
            
            while ($registro = mysqli_fetch_array($ejecutar)){
          
              //Proceso SDA
              $evaluar=substr($registro['cie10'],0,3);
                if ($evaluar=="A00" or $evaluar=="A09" or $evaluar=="A08"){
                  if ($registro['edad']<=4 and $registro['tipo_edad']=="A"){
                    $d0a4++;
                  }else if ($registro['edad']>=5 and $registro['edad']<=9 and $registro['tipo_edad']=="A"){
                    $d5a9++;
                  }else if ($registro['edad']>=10 and $registro['edad']<=14 and $registro['tipo_edad']=="A"){
                    $d10a14++;
                  }else if ($registro['edad']>=15 and $registro['edad']<=19 and $registro['tipo_edad']=="A"){
                    $d15a19++;
                  }else if ($registro['edad']>=20 and $registro['edad']<=24 and $registro['tipo_edad']=="A"){
                    $d20a24++;
                  }else if ($registro['edad']>=25 and $registro['edad']<=29 and $registro['tipo_edad']=="A"){
                    $d25a29++;
                  }else if ($registro['edad']>=30 and $registro['tipo_edad']=="A"){
                    $d30aSUP++;
                  }
        
                  if ($registro['edad']>=0 and $registro['edad']<=11 and $registro['tipo_edad']=="M"){
                    $d0a4++;
                  }
                }  

              //Proceso de categorización
              if ($registro['categorizacion']=="C5"){
                if ($registro['sexo']=="M"){
                  $C5M++;
                }else{
                  $C5F++;
                }
              }else if ($registro['categorizacion']=="C4"){
                if ($registro['sexo']=="M"){
                  $C4M++;
                }else{
                  $C4F++;
                }
              }else if ($registro['categorizacion']=="C3"){
                if ($registro['sexo']=="M"){
                  $C3M++;
                }else{
                  $C3F++;
                }
              }else if ($registro['categorizacion']=="C2"){
                if ($registro['sexo']=="M"){
                  $C2M++;
                }else{
                  $C2F++;
                }
              }else if ($registro['categorizacion']=="C1"){
                if ($registro['sexo']=="M"){
                  $C1M++;
                }else{
                  $C1F++;
                }
              }
              
              //Proceso de medicos
              $pos=0;
              $continuar=true;
              $cantidadArreglo=sizeof($nombreMedico);
              if ($cantidadArreglo==0){
                $nombreMedico[$pos]=$registro['nombre_profesional'];
                $pacientesAtendidosMedicos[$pos]=1;
              }else{
                while ($continuar){
                  if ($pos+1<=$cantidadArreglo){
                    if ($registro['nombre_profesional']==$nombreMedico[$pos]){
                      $pacientesAtendidosMedicos[$pos]++;
                      $continuar=false;
                    }
                    $pos++;
                  }else{
                    $nombreMedico[$pos]=$registro['nombre_profesional'];
                    $pacientesAtendidosMedicos[$pos]=1;
                    $continuar=false;
                  }
                } 
              }      
              
              //Proceso de sectores
              $pos=0;
              $continuar=true;
              $cantidadArreglo=sizeof($sectoresLugares);
              if ($cantidadArreglo==0){
                $sectoresLugares[$pos]=$registro['desc_centro_inscripcion'];
                $cantidadSectoresLugares[$pos]=1;
              }else{
                while ($continuar){
                  if ($pos+1<=$cantidadArreglo){
                    if ($registro['desc_centro_inscripcion']==$sectoresLugares[$pos]){
                      $cantidadSectoresLugares[$pos]++;
                      $continuar=false;
                    }
                    $pos++;
                  }else{
                    $sectoresLugares[$pos]=$registro['desc_centro_inscripcion'];
                    $cantidadSectoresLugares[$pos]=1;
                    $continuar=false;
                  }
                } 
              }   
              //Captura de sospecha covid   
              if ($registro['cie10']=="U072"){ 
                $c19Sospecha++; 
              }
              //Captura de covid positivo
              if ($registro['cie10']=="U071"){ 
                $c19Positivo++; 
              }
        
              //Captura de constatación de lesiones
              if ($registro['cod_consulta']==106){ 
                $constatacion++; 
              }
        
              //Captura de contatación de lesiones + alcoholemia
              if ($registro['cod_consulta']==124){ 
                $constatacion++; 
                $constAlcoholemias++; 
              }
        
              //Captura de varicelas
              if ($registro['cie10']=="B019"){
                if ($registro['edad']<15){ 
                  $varicelasMenor15++; 
                }else{
                  $varicelasMayor15++; 
                }
              }
        
              //Captura de Gripes
              if ($registro['cie10']=="J118"){ 
                $gripes++; 
              }

            }
            //Fin cilo While y Finalizado el conteo
            $cantidadRegistros=$cantidadRegistros-($varicelasMenor15+$varicelasMayor15+$constatacion
                                +$constAlcoholemias+$c19Sospecha+$c19Positivo);

            $admCierra=$_SESSION['nombres'];
                     
            //include('conexion.php');
            //$consulta="UPDATE tabla_procesamiento SET fecha_proceso='".$fechaCerrar."', estado='".$turnoCerrar."' , adm_quien_cierra='".$admCierra."' WHERE estado=0";
            //$ejecutar=$conexion->query($consulta);
            //mysqli_close($conexion);

            //Fin de marca
            
            //Pasar las variables POST para ser imprimidad en el PDF
            
            //Variables SDA
            echo "<input type='hidden' id='d0a4' name='d0a4' value='".$d0a4."' >";
            echo "<input type='hidden' id='d5a9' name='d5a9' value='".$d5a9."' >";
            echo "<input type='hidden' id='d10a14' name='d10a14' value='".$d10a14."' >";
            echo "<input type='hidden' id='d15a19' name='d15a19' value='".$d15a19."' >";
            echo "<input type='hidden' id='d20a24' name='d20a24' value='".$d20a24."' >";
            echo "<input type='hidden' id='d25a29' name='d25a29' value='".$d25a29."' >";
            echo "<input type='hidden' id='d30aSUP' name='d30aSUP' value='".$d30aSUP."' >";

            //Variables categorización
            echo "<input type='hidden' id='C1M' name='C1M' value='".$C1M."' >";
            echo "<input type='hidden' id='C1F' name='C1F' value='".$C1F."' >";
            echo "<input type='hidden' id='C2M' name='C2M' value='".$C2M."' >";
            echo "<input type='hidden' id='C2F' name='C2F' value='".$C2F."' >";
            echo "<input type='hidden' id='C3M' name='C3M' value='".$C3M."' >";
            echo "<input type='hidden' id='C3F' name='C3F' value='".$C3F."' >";
            echo "<input type='hidden' id='C4M' name='C4M' value='".$C4M."' >";
            echo "<input type='hidden' id='C4F' name='C4F' value='".$C4F."' >";
            echo "<input type='hidden' id='C5M' name='C5M' value='".$C5M."' >";
            echo "<input type='hidden' id='C5F' name='C5F' value='".$C5F."' >";

            //Arreglo nombre médico y pacientes atendidos
            $_SESSION['nombreMedico'] = $nombreMedico;
            $_SESSION['pacientesAtendidosMedicos'] = $pacientesAtendidosMedicos;

            //Arreglo sectores con sus cantidades
            $_SESSION['sectoresLugares'] = $sectoresLugares;
            $_SESSION['cantidadSectoresLugares'] = $cantidadSectoresLugares;
            
            echo "<input type='hidden' id='c19Sospecha' name='c19Sospecha' value='".$c19Sospecha."' >";
            echo "<input type='hidden' id='c19Positivo' name='c19Positivo' value='".$c19Positivo."' >";

            
            //Variable varicelas
            echo "<input type='hidden' id='varicelasMenor15' name='varicelasMenor15' value='".$varicelasMenor15."' >";
            echo "<input type='hidden' id='varicelasMayor15' name='varicelasMayor15' value='".$varicelasMayor15."' >";

            //Variable Gripes
            echo "<input type='hidden' id='gripes' name='gripes' value='".$gripes."' >";

            //Administrativo, fecha y turno quien cierra
            echo "<input type='hidden' id='admCierra' name='admCierra' value='".$admCierra."' >";
            echo "<input type='hidden' id='fechaCerrar' name='fechaCerrar' value='".$fechaCerrar."' >";
            echo "<input type='hidden' id='turnoCerrar' name='turnoCerrar' value='".$turnoCerrar."' >";

            //Total otras consultas
            echo "<input type='hidden' id='cantidadRegistros' name='cantidadRegistros' value='".$cantidadRegistros."' >";


            //Constatación y alcoholemias
            echo "<input type='hidden' id='constatacion' name='constatacion' value='".$constatacion."' >";
            echo "<input type='hidden' id='constAlcoholemias' name='constAlcoholemias' value='".$constAlcoholemias."' >";
            
          ?>
          
          
          <button id="botonAceptarProcesoMenu" type="submmit" name="datosPDF" class="btn btn-success" script language="javascript">Genera PDF de lo procesado</button>
         
         

        </form>
       
      </div>
    </div>
  </div>
</body>
</html>
