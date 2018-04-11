<?php 
	require 'MovieController.php';
	$Pelicula = new MovieController();
	$validarSubida = $Pelicula->registrarPelicula();
	//Valido que la respuesta sea String y no FALSE
	if(is_string($validarSubida)){
		echo $validarSubida;
	}else{
		echo "error";
	}
?>