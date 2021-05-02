<?php


 	require_once 'Models/PacienteModel.php';

	class PacientController{


		public function  paciente(){  // ----> muestra total de pacientes

			$_pacienteMod = new PacienteModel;
			$datapac = $_pacienteMod->get_pacientes();
			$result = "";
			foreach ($datapac as   $value) {				
			$result .="
				<tr>
				<td> ".$value['dni']."</td>
				<td>".$value['nombre']." ".$value['apellido_paterno']."  ".$value['apellido_materno']."</td>
				<td>". $value['sexo']."</td>
				<td>". $value['domicilio']."</td>
				<td>
				<a href='Controllers/pdfhistorial.php?id=". $value['paciente_id']."' target=”_blank”><span > <i class='fas fa-address-card'></i></span> Historial Clinico</a>
				</td>
				</tr>";
			}
 			echo $result;
		}




	}








