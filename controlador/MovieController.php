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
			$respuesta ="<div class='row'>"; //abrimos la fila
			while($fila = $catalogo->fetch_assoc()) {	
				$respuesta .="<div class='col-lg-6 mb-1 mt-1'>"; //abrimos la columna
				$respuesta .="<div class='card'>"; //abrimos cuerpo
				$respuesta .="<div class='card-header'>"; //abrimos cuerpo
					$respuesta .="<form id='EditForm"; //iniciamos el formulario
					$respuesta .=$fila['idMovie']; //el id
					$respuesta .="' name='EditForm' class='form-inline my-2 my-lg-0' method='post' enctype='multipart/form-data'>"; 
						$respuesta .="<input disabled class='nuevoTitulo form-control' type='text' value='"; //colomanos es text donde ira el nombre
						$respuesta .=substr($fila['title'],0,-4); //Añadimos el titulo
						$respuesta .="'>"; //cerramos el text
						$respuesta .="<input type='button' id='";
						$respuesta .=$fila['idMovie']; //el id
						$respuesta .="' class='editarButton btn btn-warning m-1' value='edit'>";
						$respuesta .="<button id='";
						$respuesta .=$fila['idMovie']; //el id
						$respuesta .="' class='eliminarButton btn btn-danger m-1'>del</button><br />";
					$respuesta .="</form>";
					$respuesta .="</div>"; //Cerramos la columna
					$respuesta .="<div class='card-body p-0'>"; //abrimos cuerpo
						$respuesta .="<video  width='100%' height='290px' controls><source src='vista/movies/";
						$respuesta .=$fila['idMovie']; //La ruta
						$respuesta .=".mp4' type='video/mp4'>Your browser does not support the video tag.</video>";
					$respuesta .="</div>"; //Cerramos la columna
				$respuesta .="</div>"; //Cerramos la columna
				$respuesta .="</div>"; //Cerramos la columna
            }
            $respuesta .="</div>"; //Cerramos la fila
            echo $respuesta;
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