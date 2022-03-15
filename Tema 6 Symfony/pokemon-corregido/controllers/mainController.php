<?php
require_once("models/UserModel.php");
require_once("models/UserRepository.php");
require_once("models/PokemonModel.php");
require_once("models/PokemonRepository.php");
require_once("models/TeamModel.php");
require_once("models/TeamRepository.php");

session_start();

if(!isset($_SESSION['user'])){
    $datos['id']=0;
    $datos['name']="";
    $datos['email']="";
    $datos['rol']=0;
    $_SESSION['user'] = new User($datos);
}

if(isset($_GET['login'])){
    require_once("controllers/loginController.php");
    die();
}

if(isset($_GET['pokemon'])){
    require_once("controllers/pokemonController.php");
}

$pokemons=PokemonRepository::getAllPokemon();//usar uno u otro, 
//insert no deja agregar un pokemon con una id de usuario y pokemon ya existente en pokedex, al ser priimary keys
$otherPokemons = PokemonRepository::getOtherPokemon($_SESSION['user']->id);

if($_SESSION['user']->rol == 2){
    $masterCreator = PokemonRepository::getMasterCreator();
    $masterTeam = PokemonRepository::getMasterTeams();
}
require_once("views/mainView.phtml");

?>