<?php 
	require 'MovieController.php';
	$Pelicula = new MovieController();
	$Pelicula->verPelicula();
	//header('Location: ../');
	//exit();
?>