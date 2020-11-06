<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: login.php');
}

require('reportes/fpdf.php');
date_default_timezone_set('America/Lima');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('img/logo.png',158,1,50);
    // Letra
    $this->SetFont('helvetica','B',12);
    $this->Ln(5);
    $this->Cell(43,15,'Fiore di Lotto',0,0,'D');

    $this->Ln(5);
    $this->SetFont('helvetica','i',8);
    $this->Cell(43,15,utf8_decode('Kennedy Norte Av. Miguel Alcivar H.'),0,0,'D'); 
    $this->Ln(5);
    $this->Cell(43,15,utf8_decode('Condominio María Isabel Mz B Villa 5 Primer Piso'),0,0,'D'); 
    $this->Ln(5);
    $this->Cell(43,15,utf8_decode('099-7388244 -- 0960597656'),0,0,'D');
    $this->Ln(5);
    $this->Cell(43,15,utf8_decode('fioredilottospa@gmail.com'),0,0,'D');
    // Salto de línea
    $this->Ln(25);
    }

   function Body() {

    $this->SetFont('helvetica', 'B', 20); //Asignar la fuente, el estilo de la fuente (negrita) y el tamaño de la fuente
    $y = $this->GetY();
    $this->SetXY(0,$y); //Ubicación según coordenadas X, Y. X=0 porque empezará desde el borde izquierdo de la página
    $this->Cell(210, 5, "Reportes de Citas", 0, 1, 'C');

    $this->SetFont('arial', 'U', 15); //Asignar la fuente, el estilo de la fuente (subrayado) y el tamaño de la fuente
    $y = $this->GetY(); 
    $this->SetXY(0, $y); //Ubicación según coordenadas X, Y. X=0 porque empezará desde el borde izquierdo de la página
    $this->Cell(10, 3, "", 0, 1, 'C');

    $this->Cell(7, 10, 'Id', 1, 0, 'C', 0);
    $this->Cell(20,10, 'Fecha', 1, 0, 'C', 0);
    $this->Cell(16,10, 'Hora', 1, 0, 'C', 0);
    $this->Cell(30,10, 'Cliente', 1, 0, 'C', 0);
    $this->Cell(30,10, 'Terapista', 1, 0, 'C', 0);
    $this->Cell(28,10, 'Consultorio', 1, 0, 'C', 0);
    $this->Cell(19,10, 'Estado', 1, 0, 'C', 0);
    $this->Cell(49,10, 'Observaciones', 1, 1, 'C', 0);
    $this->SetFont('arial','I',10);
    
   }
// Pie de página
function Footer(){
  $this->SetFont('helvetica','B',10);
    $this->Cell(0,10,utf8_decode('Reporte automatico generado con éxito...'),0,0,'D');
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Pagina ').$this->PageNo().'/{nb}',0,0,'C');
      }
}

require ('reportes/conexion.php');

/*$paciente="";
$terapista="";
$limit="";

$paciente=$_POST['xc'];
$terapista=$_POST['xt'];
$limit=$_POST['xr'];

$consulta = "SELECT * FROM citas where citPaciente like '%".$paciente."%' and citMedico = '".$terapista."' and '$limit'";
$resultado = $mysqli->query($consulta);*/

$consulta = "SELECT * FROM citas order by cithora";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Body();

while($row = $resultado->fetch_assoc()){
  $pdf->Cell(7, 10, $row['idcita'],1, 0,'C',0);
  $pdf->Cell(20,10, $row['citfecha'],1,0,'C',0);
  $pdf->Cell(16,10, $row['cithora'],1,0,'C',0);
  $pdf->Cell(30,10, $row['citPaciente'],1,0,'C',0);
  $pdf->Cell(30,10, $row['citMedico'],1,0,'C',0);
  $pdf->Cell(28,10, $row['citConsultorio'],1,0,'C',0);
  $pdf->Cell(19,10, $row['citestado'],1,0,'C',0);
  $pdf->Cell(49,10, $row['citobservaciones'],1,1,'C',0);

}
$pdf->Output('Reporte_Fiore_di_Lotto_'.date("d_m_Y_H_i_s"), 'I');
?>