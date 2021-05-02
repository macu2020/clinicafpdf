<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FPDF con WebM@c</title>
	<link rel="icon" href="Assets/img/logowebmacuri.png">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>
<body>
	<h1>Uso de libreria FPF en WebM@c</h1>
<div class="row">		
      <h3>Lista de Pacientes <span><i class="fas fa-users"></i></span></h3>
</div>

<div class="row mt-3">
	
	<table id="clinica" class="display table table-bordered table-striped text-center" cellspacing="0" width="100%">
		<thead class="thedtable">
			<tr>
			<th>DNI</th>
			<th>NOMBRE</th>
			<th>GENERO</th>
			<th>DIRECCION</th>
			<th>HISTORIAL</th>
			</tr>
		</thead>
		
			<?php 
				$macuri=new PacientController;
				$macuri->paciente();
			 ?>
		
	</table>	
</div>
			

 

</body>
</html>