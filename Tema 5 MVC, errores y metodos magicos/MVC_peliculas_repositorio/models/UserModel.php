<?php
class User{
    private $id;
    private $name;
    private $rol;

    //Validacion, en repositorio, en constructor o en otro metodo de esta clase. Elegido repositorio.

    public function __construct($datos){
        $this->id = $datos['id'];
        $this->name = $datos['username'];
        $this->rol = $datos['rol'];
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getRol(){
        return $this->rol;
    }

}
?>