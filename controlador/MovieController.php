<?php
	require_once '../modelo/Movie.php';

	class MovieController{

		function __construct(){

		}

		function registrarPelicula(){
			$dir_subida = "../vista/movies/";
			$pelicula = new Movie();

			$pelicula->setTitle(basename($_FILES['fichero_usuario']['name']));
			$pelicula->setIdUsuario(1);
			$pelicula->setIdGenre(1);
			
			$fichero_subido = $dir_subida . $pelicula->getTitle();
			//echo $fichero_subido;
			
			if (move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $fichero_subido)) {
			    //echo "El fichero es válido y se subió con éxito.\n";
			    $pelicula->setIdMovie($pelicula->crearPelicula($pelicula));
			    rename ($dir_subida.$pelicula->getTitle(),$dir_subida.$pelicula->getIdMovie().".mp4");
			    /*
			    $respuesta="<p>";
			    $respuesta .="<input type='text' value='";
			    $respuesta .=substr($pelicula->getTitle(),0,-4);
			    $respuesta .="'>"; //abrimos parrafo
			    $respuesta .="<button id='";
				$respuesta .=$pelicula->getIdMovie(); //el id
				$respuesta .="' class='eliminarButton'>del</button></br >";
			    $respuesta .="<br /><video id='";
			    $respuesta .=$pelicula->getIdMovie();
			    $respuesta .="' width='320' height='240' controls><source src='vista/movies/";
			    $respuesta .=$pelicula->getIdMovie();
			    $respuesta .="' type='video/mp4'>Your browser does not support the video tag.</video>";
				$respuesta .="</p>"; //Cerramos el parrafo
				*/
			    return "Exito";
			} else {
				return false;
			    //echo "No se pudo subir el archivo\n";
			}
			//echo 'Más información de depuración:';
			//print_r($_FILES);
		}

		function verPelicula(){
			$pelicula = new Movie();
			$catalogo = $pelicula->verPeliculas();
			$respuesta;
			while($fila = $catalogo->fetch_assoc()) {	
				$respuesta ="<p  style='border-style: solid;'>"; //abrimos parrafo
				$respuesta .="<form id='EditForm";
				$respuesta .=$fila['idMovie']; //el id
				$respuesta .="' name='EditForm' method='post' enctype='multipart/form-data'>"; //abrimos parrafo
				$respuesta .="<input class='nuevoTitulo' type='text' value='";
				$respuesta .=substr($fila['title'],0,-4); //Añadimos el titulo
				$respuesta .="'>"; //abrimos parrafo
				$respuesta .="<input type='button' id='";
				$respuesta .=$fila['idMovie']; //el id
				$respuesta .="' class='editarButton' value='edit'>";
				$respuesta .="<button id='";
				$respuesta .=$fila['idMovie']; //el id
				$respuesta .="' class='eliminarButton'>del</button><br />";
				$respuesta .="</form>";
				$respuesta .="<video width='320' height='240' controls><source src='vista/movies/";
				$respuesta .=$fila['idMovie']; //La ruta
				$respuesta .=".mp4' type='video/mp4'>Your browser does not support the video tag.</video>";
				$respuesta .="</p>"; //Cerramos el parrafo
                echo $respuesta;
            }
		}

		function eliminarPelicula($id){
			$dir_subida = "../vista/movies/";
			$pelicula = new Movie();
			$borrado = $pelicula->eliminarPelicula($id);
			if($borrado){
				while(unlink($dir_subida.$id.".mp4")==false){
					//forzamos el borrado
					unlink($dir_subida.$id.".mp4");
				}
			}
			return $borrado
;		}
	}
?>