<?php 



	class EnlacesController{
		
		public function enlacesControll(){
			if (isset($_GET["action"])) {
				$enlace=$_GET["action"];
			}else{
				$enlace="index";
			}
			$respuesta = EnlacesModels::enlacesModel($enlace);
			include $respuesta;		
		}

	}