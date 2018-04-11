|<?php 
	require 'MovieController.php';
	$Pelicula = new MovieController();
	$confirmarBorrado = $Pelicula->eliminarPelicula($_POST["idPelicula"]);
	//Valido que la respuesta sea String y no FALSE
	if($confirmarBorrado){
		echo $confirmarBorrado;
	}else{
		echo "error";
	}
?>