
<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>TEST</title>
    <meta name="description" content="${2}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="vista/js/jquery-3.3.1.min.js"></script>
    <script src="vista/js/bootstrap.min.js"></script>
    <script src="vista/js/popper.min.js"></script>
    <link rel="stylesheet" href="vista/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="vista/css/PersonalFlix.css" type="text/css">
    <!--<script src="http://malsup.github.com/jquery.form.js"></script> -->
    <script>

        function iniciarPagina(){
            $.ajax({
                    type: "POST",
                    url: "controlador/VerCatalogo.php",
                    data: "",
                    dataType: "html",
                    beforeSend: function(){
                          //imagen de carga                                             
                          //$("#barraDeCarga").empty();
                          //$("#barraDeCarga").html("<p align='center'><img src='vista/images/ajax-loader.gif' /></p>");
                    },
                    error: function(){
                          alert("error petición ajax");
                    },
                    success: function(data){                                                  
                        $("#resultado").empty();
                        $("#resultado").append(data);
                    }
              });
        }

        function subirPelicula(formData){
            $.ajax({
                url: 'controlador/UploadMovie.php', //Ruta a donde se comunicara
                xhr: function(){
                    var xhr = new window.XMLHttpRequest();
                    //Upload progress
                    xhr.upload.addEventListener("progress", function(evt){
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total)*100;
                            $(".barraDeCarga").css("display","block");
                            $(".progreso").css("width",percentComplete+"%");
                            $(".progreso").html(percentComplete.toFixed(0)+"%");
                        }
                    }, false);
                    return xhr;
                  },
                data: formData, //El formulario
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST', //Metodo de envio 
                beforeSend: function(){
                        $(".barraDeCarga").css("display","block");
                          //imagen de carga
                          //$("#barraDeCarga").html("<p align  ='center'><img src='vista/images/ajax-loader.gif' /></p>");
                    },   
                success: function(data){
                    document.getElementById("IDformUpVideo").reset();
                    $(".barraDeCarga").css("display","none");
                    iniciarPagina();
                    /*
                    //Si funciona entonces validamos la respuesta del servidor
                    if(data=="error"){
                        //Si PHP responde con la palabra error entonces no se subio
                        alert("No se subio"+data);
                    }else{
                        //Si responde con otro tipo de texto entonces si se subio el archivo
                        //$("#barraDeCarga").empty(); 
                        $("#pogreso").html("Completado :3");                                               
                        $("#resultado").append(data);
                    }
                    */
                }
            });
        }

        function eliminarPelicula(buttonId){
            //alert(buttonId);
            $.ajax({
                    type: "POST",
                    url: "controlador/DeleteMovie.php",
                    xhr: function(){
                        var xhr = new window.XMLHttpRequest();
                        //Upload progress
                        xhr.upload.addEventListener("progress", function(evt){
                            if (evt.lengthComputable) {
                                var percentComplete = (evt.loaded / evt.total)*100;
                                $("#pogreso").css("width",percentComplete+"%");
                                $("#pogreso").html(percentComplete.toFixed(0)+"%");
                            }
                        }, false);
                        return xhr;
                    },
                    data: {"idPelicula": buttonId},
                    dataType: "html",
                    beforeSend: function(){
                          //imagen de carga
                          //$("#barraDeCarga").html("<p align='center'><img src='vista/images/ajax-loader.gif' /></p>");
                    },
                    error: function(){
                          alert("error petición ajax");
                    },
                    success: function(data){ 
                        //alert("Archivo borrado");
                                                                   
                        iniciarPagina();
                    }
              });
        }

    	$(document).ready(function(){
            //Cargamos las peliculas
		    iniciarPagina();
            //Cuando se suba un video
            $('#IDformUpVideo').submit(function(e) { 
                //Evitamos el Refresh del form
                e.preventDefault();   
                //Creamos un Formdata
                var formData = new FormData(this);
                //Invocamos al metodo subir pelicula y le pasamos el valor del formulario
                subirPelicula(formData);
            });
        });

        $(document).on('click','.eliminarButton',  function (event) {
            event.preventDefault();
            eliminarPelicula(event.target.id);
        });

        $(document).on('click','.editarButton',  function (event) {
            event.preventDefault();
            alert("id Button"+event.target.id);

            alert("Texto"+$('#EditForm'+event.target.id+' .nuevoTitulo').val());
        });
    </script>
</head> 
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark  sticky-top">
        <a class="navbar-brand" href="#">PersonalFlix</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle  bg-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Explorar    
                    </a>
                    <div class="dropdown-menu " aria-labelledby="navbarDropdown"> 
                         <a class="dropdown-item" href="#">2018</a>
                          <a class="dropdown-item" href="#">2017</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle  bg-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Inicia Sesion
                    </a>
                    <div class="dropdown-menu " aria-labelledby="navbarDropdown"> 
                        <form class="form-inline my-2 my-lg-0">
                            <input type="text" class="form-control ml-2 mr-2 mb-1" placeholder="Usuario" name="txtUser">
                            <input type="password" class="form-control ml-2 mr-2"  placeholder="Contraseña" name="txtPassword">
                            <input class="btn btn-success ml-2 mr-2 mt-2" type="submit" name="btnLogin">
                        </form>
                    </div>
                </li>
                <li>
                    <form  class="form-inline my-2 my-lg-0" id="IDformUpVideo" name="NAMEformUpVideo" method="post" enctype="multipart/form-data">
                        <input class="form-control mr-sm-2" accept=".mp4" type="file" name="fichero_usuario" id="fichero_usuario">
                        <input  class="btn btn-outline-success my-2 my-sm-0" class="button" type="submit" value="subir" />
                    </form>
                </li>
            </ul>
            
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </div>
    </nav>
     <div class="barraDeCarga progress">
        <div class="progreso progress-bar bg-secondary">Esperando</div>
    </div>
	<div class="container cuerpoPrincipal">
		<h1>Catalogo</h1>
        <div class="container" id="resultado">
            resultado
        </div>
    </div>
</div>
</body>
</html>