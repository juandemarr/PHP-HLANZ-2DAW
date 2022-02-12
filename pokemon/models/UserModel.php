<?php
class User{
    private $id;
    private $name;
    private $rol;

    public function __construct($data){
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->rol = $data['rol'];
    }

    public function __get($p){
        if(property_exists($this,$p))
            return $this->$p;
    }

}
?>