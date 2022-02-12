<?php
//Recibo las variables de la vista y calculo

//cargamos el modelo
require_once("models/PeliModel.php");
require_once("models/PeliRepository.php");
require_once("models/UserModel.php");
require_once("models/UserRepository.php");

session_start();//heredable para el resto de documentos
//tiene que estar despues de los modelos, sino no reconoce al objeto user

if(!isset($_SESSION['user'])){
    $datos['id']=0;
    $datos['username']="";
    $datos['rol']=0;
    $_SESSION['user'] = new User($datos);
}

if(isset($_GET['login'])){
    require_once("controllers/LoginController.php");
    die();//para matar a este controlador, parar su ejecucion, ya que en el login no se valida nada de lo de abajo
}


//usar el repositorio para cargar los datos
if(isset($_GET['like']) && isset($_GET['id'])){
    //camino facil pasandole el id a un metodo del repositorio
    //PeliRepository::addLike($_GET['like']);

    //camino dificil
    //cargar instancia de pelicula
    $movie=PeliRepository::getMovieById($_GET['id']);
    //actualizar datos de pelicula
    //$movie->addLike('+1');2 forma
    $movie->addLike($_GET['like']);//3 forma
//}else if(isset($_GET['dislike'])){
    //$movie=PeliRepository::getMovieById($_GET['dislike']);
    //$movie->addDislike();//1 forma. Dos metodos para addLike y addDislike
    //$movie->addLike('-1');//2 forma pasandole al mismo metodo addLike el +1 o -1 para usarlo 
    //en la funcion como variable de cantidad
}


if(isset($_GET['info'])){
    if($movie=PeliRepository::getMovieById($_GET['info']))
        require_once("views/PeliView.phtml");
    
}else{
    if(isset($_POST['busca']))
        $movies=PeliRepository::getMovieByTitle($_POST['busca']);
    else if(isset($_POST['ordenar']))
        $movies=PeliRepository::orderByYear($_POST['ordenar']);
    else if(isset($_GET['year']))
        $movies=PeliRepository::getMoviesByYear($_GET['year']);
    else 
        $movies=PeliRepository::getMovies();
    
    require_once("views/ListView.phtml");
}


?>