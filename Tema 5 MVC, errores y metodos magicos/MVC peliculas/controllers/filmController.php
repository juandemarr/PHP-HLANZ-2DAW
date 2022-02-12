<?php 
    //call to the model
    require_once("models/filmModel.php");
    //use the model
    $films = new filmModel();

    if(isset($_GET['like'])){ //se controla si hay like y llama al metodo añadir like del modelo pelicula
        if(!$films->addLike($_GET['like']))
            $info = "falló el like";
        else $info = "like correcto";
    }


    if(isset($_GET['info'])){
        //coger datos de pelicula correcta
        $filmDetail = $films->getFilmDetail($_GET['info']);

        //llamar a la vista de info
        require_once("views/filmDetailView.php");

    }else{
        //primero se hacen las actualizaciones y al final se obtienen los datos
        $filmsData = $films->getFilms();

        //llamar a la vista generica
        require_once("views/filmView.php");
    }



    
?>