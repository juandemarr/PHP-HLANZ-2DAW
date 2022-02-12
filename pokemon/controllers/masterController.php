<?php
if(isset($_GET['registerPokemon'])){
    if(isset($_POST['submitPokemon'])){//como no se repiten y el nombre es unico, sera la clave primaria
        if(!empty($_POST['name']) && !empty($_POST['type']) && !empty($_POST['img'])){
            if(!PokemonRepository::checkName($_POST['name'])){//si no está en la base de datos por ende no está en la pokedex
                if($_SESSION['user']->rol==2){
                    PokemonRepository::register($_POST['name'],$_POST['type'],$_POST['img']);
                    header("location:index.php");
                }else{
                    PokemonRepository::register($_POST['name'],$_POST['type'],$_POST['img']);
                    PokemonRepository::registerPokedex($_SESSION['user']->id,$_POST['name']);
                    header("location:index.php");
                }
                
            }else
                require_once("views/registerPokemonView.phtml"); 
        }else 
            require_once("views/registerPokemonView.phtml");
    }else
        require_once("views/registerPokemonView.phtml");
}else if(isset($_GET['registerTeam'])){
    if(isset($_POST['submitTeam'])){
        
    }else
        require_once("views/registerTeamView.phtml");
}



?>