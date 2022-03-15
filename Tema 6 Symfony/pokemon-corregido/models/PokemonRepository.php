<?php
class PokemonRepository{
    public static function getAllPokemon(){
        $db=Conectar::conexion();
        $result= $db->query("SELECT * FROM pokemon");
        $pokemons=array();
        while($datos=$result->fetch_assoc())
            $pokemons[]= new Pokemon($datos);
        return $pokemons;
    }
    public static function getOtherPokemon($id){
        $db=Conectar::conexion();
        $result= $db->query("SELECT p.id, name, type, image FROM pokemon p,userpokemon u where p.id = u.idPokemon
            and p.id not in(select idPokemon from userpokemon where idUser = ".$id.")");
        $pokemons=array();
        while($datos=$result->fetch_assoc())
            $pokemons[]= new Pokemon($datos);
        return $pokemons;
    }
    public static function addPokemon($datos){
        $db=Conectar::conexion();
        //se puede controlar que no exista previamente aqui o en le controlador
        $db->query("insert into pokemon values('','".$datos['name']."','".$datos['type']."','".$datos['image']."',".$_SESSION['user']->id.")");
        return $db->insert_id;//para coger el ultimo id
    }
    public static function getPokemonByUser($id){
        $db=Conectar::conexion();
        $result= $db->query("SELECT p.id, name, type, image FROM pokemon p,userpokemon u 
            where p.id = u.idPokemon and u.idUser = ".$id);
        $pokemons=array();
        while($datos=$result->fetch_assoc())
            $pokemons[]= new Pokemon($datos);
        return $pokemons;
    }
    public static function addPokedex($id){
        $db=Conectar::conexion();
        $db->query("insert into userpokemon values(".$_SESSION['user']->id.",".$id.")");
    }
    public static function getPokemonByName($name){
        $db=Conectar::conexion();
        $result= $db->query("SELECT * FROM pokemon where name = '".$name."'");
        if($datos=$result->fetch_assoc())
            return new Pokemon($datos);
        else
            return false;
    }
    public static function getPokemonById($id){
        $db=Conectar::conexion();
        $result= $db->query("SELECT * FROM pokemon where id = ".$id);
        if($datos=$result->fetch_assoc())
            return new Pokemon($datos);
        else
            return false;
    }
    public static function getMasterCreator(){
        $db=Conectar::conexion();
        $result= $db->query("SELECT userId,count(id) as total FROM pokemon group by userId order by total desc limit 1");
        if($datos=$result->fetch_assoc())
            return UserRepository::getUserById($datos['userId']);
        else return false;
    }
    public static function getMasterTeams(){
        $db=Conectar::conexion();
        $result= $db->query("SELECT idUser,count(id) as total FROM team group by idUser order by total desc limit 1");
        if($datos=$result->fetch_assoc())
            return UserRepository::getUserById($datos['idUser']);
        else return false;
    }
}
?>