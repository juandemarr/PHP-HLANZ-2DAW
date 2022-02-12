<?php
class Pokedex{
    private $id;
    private $idUser;
    private $namePokemon;

    public function __construct($data){
        $this->id = $data['id'];
        $this->idUser = $data['idUser'];
        $this->namePokemon = $data['namePokemon'];
    }
    public function __get($p){
        if(property_exists($this,$p))
            return $this->$p;
    }

}
?>