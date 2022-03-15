<?php
class Team{
    private $id;
    private $name;
    private $pokemon1,$pokemon2,$pokemon3,$pokemon4,$pokemon5;

    public function __construct($data){
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->pokemon1 = PokemonRepository::getPokemonById($data['idP1']);
        //Para evitar hacer luego una consulta con el id para obtener el nombre, creo el objeto pokemon directamente aqui y lo tendria todo
        $this->pokemon2 = PokemonRepository::getPokemonById($data['idP2']);
        $this->pokemon3 = PokemonRepository::getPokemonById($data['idP3']);
        $this->pokemon4 = PokemonRepository::getPokemonById($data['idP4']);
        $this->pokemon5 = PokemonRepository::getPokemonById($data['idP5']);
    }
    public function __get($p){
        if(property_exists($this,$p))
            return $this->$p;
    }
    public function __toString(){
        return $this->name.": ".$this->pokemon1.",".$this->pokemon2.",".$this->pokemon3.",".$this->pokemon4.",".$this->pokemon5;
    }

}
?>