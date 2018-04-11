<?php 
	require "../config/configuracion.php";

	class BD{
		function conectarBase(){
			$mysqli = new mysqli(BD_HOST, BD_USUARIO,BD_PASSWORD, BD_NOMBRE_BASE);
			if ($mysqli -> connect_errno) {
				//echo "Error al conectar a MySQL: " . mysqli_connect_error();
			}else{
				//echo "<br /> conexion exitosa";
			}
			return $mysqli;
			//echo "Conexión exitosa!";
			//mysqli_close($mysqli);
		}
	}
?>