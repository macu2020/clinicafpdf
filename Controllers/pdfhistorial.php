<?php

require_once '../Assets/Lib/fpdf-libreria/fpdf.php';
require_once '../Models/PacienteModel.php'; //listamos pacientes  y consulta

class PDF extends FPDF{
		var $widths;
		var $aligns;

	function SetWidths($w){
		$this->widths=$w;
	}

	function SetAligns($a){
		$this->aligns=$a;
	}

	function Row($data){

		$nb=0;
		for($i=0;$i<count($data);$i++){
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=8*$nb;

		$this->CheckPageBreak($h);

			for($i=0;$i<count($data);$i++){

			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';

			$x=$this->GetX();
			$y=$this->GetY();


			$this->Rect($x,$y,$w,$h);

			$this->MultiCell($w,8,$data[$i],0,$a,'true');

			$this->SetXY($x+$w,$y);
			}

		}
		$this->Ln($h);
	}

	function CheckPageBreak($h){
		if($this->GetY()+$h>$this->PageBreakTrigger){
		$this->AddPage($this->CurOrientation);
		}
	}

	function NbLines($w,$txt){
		$cw=&$this->CurrentFont['cw'];

		if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
			$sep=-1;
			$i=0;
			$j=0;
			$l=0;
			$nl=1;
		while($i<$nb){
			$c=$s[$i];
			if($c=="\n")
			{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		continue;
		}
		if($c==' ')
			$sep=$i;
		 
			$l+=$cw[$c];
		if($l>$wmax){
			if($sep==-1){
				if($i==$j)
					$i++;
			}
			else
			$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
		}
		return $nl;
	}

	function Header(){
		$this->SetFont('Arial','',10);
		$this->Text(20,14,'Historial clinico - Clinica la Luz',0,'C', 0);
		$this->Ln(10);
	}

	function Footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','B',8);
		$this->Cell(100,10,'Historial del paciente',0,0,'L');

	}

}

// Obtenemos el id del paciente
$paciente_id= $_GET['id'];
// Creamos nuestro objeto paciente
$objpaciente = new PacienteModel();
// obtenemos los datos del paciente por el id
 
$paciente = $objpaciente->paciente_id($paciente_id);

// Creamos nuestro objeto pdf
$pdf=new Pdf();
// Agregamos una pagina al archivo
$pdf->AddPage();
// Personalizamos los amrgenes
$pdf->SetMargins(20,20,20);
// Creamos un espacio
$pdf->Ln(10);
// Definimos la fuente y tamaño
$pdf->SetFont('Arial','',12);
// Creamos una celda para mostrar la información
$pdf->Cell(30,6,'DNI: ',0,0);
$pdf->Cell(0,6,$paciente['dni'],0,1);
$pdf->Cell(30,6,'NOMBRE: ',0,0);
$pdf->Cell(0,6,$paciente['nombre'].' '.$paciente['apellido_paterno'].' '.$paciente['apellido_materno'],0,1);
$pdf->Cell(30,6,'SEXO: ',0,0);
$pdf->Cell(0,6,$paciente['sexo'],0,1);
$pdf->Cell(30,6,'DOMICILIO: ',0,0); 
$pdf->Cell(0,6,$paciente['domicilio'],0,1);
// Usamos la funcio imagen, para obtenr la ruta de la imagen usamos nuestra funcion ruta de conexion

$pdf->Image( 'http://localhost/ClinicaFpdf/upload/pacientes/'.$paciente['foto'],155,20,30,30);
																// 155  es el left
																// 20 es el top
																// 30 es el width
																// 30 es el alto

$pdf->Ln(10);

$pdf->SetWidths(array(10, 20, 50, 30, 40,20));  //este es el anchoy cuenta columnas
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(29,29,29);
$pdf->SetTextColor(255);
// usamos nuestra funcion creada para listar celdas con varias lineas
$pdf->Row(array('#','FECHA', 'MEDICO', 'CONSULTORIO', 'DIAGNOSTICO', 'macuri'));
// Creamos nuestra funcion consulta
$objconsulta = new PacienteModel();
$consultas = $objconsulta->consultasPaciente($paciente_id);

$i = 0;
// listamos las consultas
$n=0;
 
foreach ($consultas as $consulta) {$n++;

$pdf->SetFont('Arial','',9);

if($i%2 == 1){
$pdf->SetFillColor(181,175,173);
$pdf->SetTextColor(0);
$pdf->Row(array($n,$consulta['fecha_consulta'], $consulta['nombre_medico'], $consulta['consultorio'], $consulta['diagnostico'], $consulta['ceulas']));
$i++;
}else{
$pdf->SetFillColor(212,204,202);
$pdf->SetTextColor(0);
$pdf->Row(array($n,$consulta['fecha_consulta'], $consulta['nombre_medico'], $consulta['consultorio'], $consulta['diagnostico'], $consulta['ceulas']));
$i++;
}
}
// Salida del archivo y nombre
$pdf->Output('reporte.pdf','I');
?>