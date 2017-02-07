<?php

	function leerDirectorio3(){
		
		try{

			$conn = new PDO('mysql:host=localhost;dbname=nombreBaseDatos', "usuarioBaseDatos", "ContraseñaBaseDatos");

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$ruta = "ruta_rchivos";
			$directorio = scandir($ruta);
			$titulos = Array();
			$rutaCompleta = "";
			
			foreach($directorio as $archivo) {
				$rutaCompleta = $ruta.$archivo;
				
				if (is_file($rutaCompleta)) {
					$sql = $conn->prepare("INSERT INTO tablaBaseDatos (ruta) VALUES (:value)");
					$sql->bindParam(':value', $rutaCompleta);
					$sql->execute();
				}
			}
		}catch(PDOException $e){
			echo "ERROR: " . $e->getMessage();
		}
	}
?>