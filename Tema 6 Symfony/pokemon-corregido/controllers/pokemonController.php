<?php
if(isset($_POST['addPokemon'])){
    if(!PokemonRepository::getPokemonByName($_POST['name'])){
        //añadir pokemon a bd
        $lastId = PokemonRepository::addPokemon($_POST);
        //este $_POST es un array con todos los datos del form, luego se cogen sus campos necesarios en el repositorio
        //para saber el ultimo id se puede hacer una consulta de todos, limit 1 y ordenarlo al contrario

        //añadir a pokedex
        PokemonRepository::addPokedex($lastId);
        //no hace falta saber el ultimo, bastaria con $_POST['id']
        header("location:index.php");
    }
}
if(isset($_GET['add'])){
    //añadir a mi pokedex
    PokemonRepository::addPokedex($_GET['add']);
    header("location:index.php");
}
if(isset($_POST['addTeam'])){
    TeamRepository::addTeam($_POST);
    header("location:index.php");
}

?>