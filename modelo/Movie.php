<?php

class Movie{
	private $idMovie;
	private $title;
	private $year;
	private $country;
	private $classification;
	private $languaje;
	private $rating;
	private $idUsuario;
	private $idGenre;

    /**
     * @param mixed $idMovie
     *
     * @return self
     */
    public function setIdMovie($idMovie)
    {
        $this->idMovie = $idMovie;

        return $this;
    }


	/**
     * @return mixed
     */
    public function getIdMovie()
    {
        return $this->idMovie;
    }

    
    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     *
     * @return self
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     *
     * @return self
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClassification()
    {
        return $this->classification;
    }

    /**
     * @param mixed $classification
     *
     * @return self
     */
    public function setClassification($classification)
    {
        $this->classification = $classification;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLanguaje()
    {
        return $this->languaje;
    }

    /**
     * @param mixed $languaje
     *
     * @return self
     */
    public function setLanguaje($languaje)
    {
        $this->languaje = $languaje;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     *
     * @return self
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * @param mixed $idUsuario
     *
     * @return self
     */
    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdGenre()
    {
        return $this->idGenre;
    }

    /**
     * @param mixed $idGenre
     *
     * @return self
     */
    public function setIdGenre($idGenre)
    {
        $this->idGenre = $idGenre;

        return $this;
    }

    public function crearPelicula($pelicula){
        require "BD.php";
        $base = new BD();
        $conexion = $base->conectarBase();
        $consulta = "INSERT INTO `movie`(title, idUsuario, idGenre) VALUES ('".$pelicula->getTitle()."','".$pelicula->getIdUsuario()."', '".$pelicula->getIdGenre()."')";
        //echo "<br />Consulta: ".$consulta;
        if ($conexion->query($consulta) === TRUE) {
            return $conexion->insert_id;
            //printf($conexion->affected_rows." Filas afectadas");
        }
        else{
            echo "<br />Error al ejecutar el comando:".$conexion->error;
        }
        mysqli_close($conexion);
    }

    public function verPeliculas(){
        require "BD.php";
        $base = new BD();
        $conexion = $base->conectarBase();
        $consulta = "SELECT * from movie";
        //echo "<br />Consulta: ".$consulta;
        if ($consultaQuery=$conexion->query($consulta)) {
            return $consultaQuery;
            /*
            while($fila = $consultaQuery->fetch_assoc()) {
                echo "id: " . $fila["idMovie"]. " - Name: " . $fila["title"]. " " . $fila["year"]. "<br>";
            }
            */
        }
        else{
            echo "<br />Error al ejecutar el comando:".$conexion->error;
        }
        mysqli_close($conexion);
    }

    public function eliminarPelicula($pelicula){
        require "BD.php";
        $base = new BD();
        $conexion = $base->conectarBase();
        $consulta = "DELETE FROM movie WHERE idMovie=".$pelicula;
        //echo "<br />Consulta: ".$consulta;
        if ($conexion->query($consulta) === TRUE) {
            return true;
            //printf($conexion->affected_rows." Filas afectadas");
        }
        else{
            return false;
        }
        mysqli_close($conexion);
    }
}