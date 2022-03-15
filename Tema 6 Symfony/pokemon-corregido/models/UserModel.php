<?php
class User{
    private $id;
    private $name;
    private $email;
    private $rol;

    public function __construct($datos){
        $this->id = $datos['id'];
        $this->name = $datos['name'];
        $this->email=$datos['email'];
        $this->rol = $datos['rol'];
    }
    public function __get($property){
        if(property_exists($this,$property))
            return $this->$property;
        else if($property=="pokedex")//se puede como modelo aparte, pero al ser solo una lista se puede usar aqui como array
            return PokemonRepository::getPokemonByUser($this->id);
        else if($property=="teams")
            return TeamRepository::getTeamsByUser($this->id);
    }
}
?>