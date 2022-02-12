<?php
//maestro,pokedex por maestro, pokemon en bd
//al crear pokemon, se puede añadir a la pokedex
//admin crea pokemon y puede ver q maestro pokemon ha creado mas, tiene mas pokemon y mas equipos
//equipos con nombre y cinco pokemon
//usuarios normales sin loguearse ven una lista de pokemon
//al darse de alta, son maestros pokemon y pueden añadirlos a su pokedex
/*
db:users,pokemon(id, nombre,tipo,foto),pokedex(idUser,idPokemon (no pokemon repetidos)), 

vista de rol == 1
    registrar pokemon
    registrar equipo
        nombre
        con 5 pokemon
    ver pokemon que tienes
    ver pokemon que no tienes

*/


//cargamos los modelos
require_once("models/UserModel.php");
require_once("models/UserRepository.php");
require_once("models/PokemonModel.php");
require_once("models/PokemonRepository.php");
require_once("models/PokedexModel.php");

session_start();

if(!isset($_SESSION['user'])){
    $data['id'] = 0;
    $data['name'] = "";
    $data['rol'] = 0;
    $_SESSION['user'] = new User($data);
}

//redirigimos a los controladores
if(isset($_GET['login'])){
    require_once("controllers/loginController.php");
    die();
}else if(isset($_GET['register'])){
    require_once("controllers/registerController.php");
    die();
}else if(isset($_GET['master'])){
    require_once("controllers/masterController.php");
    die();
}



else if(isset($_GET['logout'])){
    session_destroy();
    header("location:index.php");
}

//cargamos las vistas
if($_SESSION['user']->rol == 2){
    require_once("views/registerPokemonView.phtml");
}else
if($_SESSION['user']->rol == 1){
    $listPokedex = PokemonRepository::listMyPokemon($_SESSION['user']->id);
    $listOtherPokemon = PokemonRepository::listOthers($_SESSION['user']->id);
    require_once("views/masterView.phtml");
}
else{
    $listPokemon = PokemonRepository::list();
    require_once("views/listView.phtml");
}
    

?>