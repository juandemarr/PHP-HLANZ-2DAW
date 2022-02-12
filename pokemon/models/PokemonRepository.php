<?php
class PokemonRepository{
    public static function list(){
        $db = Connection::connect();
        $result = $db->query("select * from pokemon");
        $listPokemon = array();
        while($data = $result->fetch_assoc())
            $listPokemon[] = new Pokemon($data);
        return $listPokemon;
    }
    public static function register($name,$type,$img){
        $db = Connection::connect();
        $db->query("insert into pokemon values('".$name."','".$type."','".$img."')");
    }
    public static function registerPokedex($idU,$nameP){
        $db = Connection::connect();
        $db->query("insert into pokedex values('','".$idU."','".$nameP."')");
    }
    public static function checkName($name){
        $db = Connection::connect();
        $result = $db->query("select * from pokemon where name = '".$name."'");
        if($data = $result->fetch_assoc())
            return true;
        else return false;
    }
    public static function listMyPokemon($idU){
        $db = Connection::connect();
        $result = $db->query("select * from pokedex where idUser = ".$idU);
        $listPokemon = array();
        while($data = $result->fetch_assoc())
            $listPokemon[] = new Pokedex($data);
        return $listPokemon;
    }
    public static function listOthers($idU){
        $db = Connection::connect();
        $result = $db->query("select * from pokemon where name not in(select name from pokedex where idUser = ".$idU.")");
        $list = array();
        while($data = $result->fetch_assoc())
            $list[] = new Pokemon($data);
        return $list;
    }

}
?>