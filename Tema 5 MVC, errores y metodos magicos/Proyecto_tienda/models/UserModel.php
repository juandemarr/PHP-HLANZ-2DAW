<?php
class User{
    private $id;
    private $name;
    private $email;
    private $rol;

    public function __construct($data){
        $this->id = $data['idUser'];
        $this->name = $data['nameUser'];
        $this->email = $data['email'];
        $this->rol = $data['rol'];
    }
    public function __get($p){
        if(property_exists($this,$p))
            return $this->$p;
    }

}

?>