<?php 


	require_once "conexion.php";
	$conex = Conexion::conectaweb();


class PacienteModel{


	public function get_pacientes(){  // -----> Muestra total pacientes 
		$conex= Conexion::conectaweb();
        $sql="SELECT * FROM pacientes";
        $stmt=$conex->prepare($sql);
        $stmt->execute();
         $resultado=$stmt->fetchAll();

		return  $resultado;
	}



	public function paciente_id($id){  // ----> Consulta por paciente id
		$conex= Conexion::conectaweb();

		$sql = sprintf("SELECT * FROM	pacientes	WHERE	paciente_id = $id");

		$stmt=$conex->prepare($sql);
		        $stmt->execute();

        $resultado=$stmt->fetch();
		return $resultado;
	}



	public function consultasPaciente($id){//-->Listamos consultas
		$conex= Conexion::conectaweb();

		$sql = "SELECT	consultas_medicas.fecha_consulta,consultas_medicas.consultorio,
		consultas_medicas.diagnostico,medicos.nombre_medico,medicos.cedula as ceulas	FROM consultas_medicas
		INNER JOIN medicos ON consultas_medicas.id_medico = medicos.medico_id	WHERE
		consultas_medicas.id_paciente = $id";

		$stmt=$conex->prepare($sql);
		$stmt->execute();

        $resultado=$stmt->fetchAll();
		return $resultado;
	}


}




 ?>