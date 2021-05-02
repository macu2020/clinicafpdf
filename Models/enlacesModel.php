<?php 


	class EnlacesModels{


			static public function enlacesModel($enlaces){
				if( $enlaces=="inicio" ||
		  			$enlaces=="salir" ){
		 			$module="Views/models/".$enlaces.".php";
		 		}
		 		else if ($enlaces =="index") {
		 			$module="Views/models/inicio.php";	
		 		}
		 		return $module;
			}

	}


 ?>