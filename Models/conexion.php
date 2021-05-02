<?php 

include 'config.php';
	

	class  Conexion{


		public static  function conectaweb(){
			try {
				 $dsn=DRIV.":host=".HOST.";dbname=".BASE.";port=".PORT;
				 $base=new PDO($dsn,USER,PASS);
				 $base->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				 $base->exec('set names utf8');
				 return $base;
			} catch (Exception $e) {
				return "fallo: ".$e->getMessage();
			}
		}


		public static function encriptacion($string){
			$output = FAlSE;
			$key    =hash('SHA256', SECRET_KEY);
			$iv     =substr(hash('SHA256', SECRET_IV), 0,16);
			$output =openssl_encrypt($string, METHOD, $key,0,$iv );
			$output =base64_encode($output);
			return $output;
		}


		public static function desencriptacion($string){
			$key    =hash('sha256', SECRET_KEY);
			$iv     =substr(hash('sha256', SECRET_IV), 0,16);
			$output =openssl_decrypt(base64_decode($string), METHOD, $key,0,$iv);
			return $output;
		}


	}



 ?>