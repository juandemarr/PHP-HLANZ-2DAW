<?php
class User{
    private $id;
    private $name;
    private $email;
    private $rol;

    public function __construct($datos){
        $this->id = $datos['id'];
        $this->name = $datos['username'];
        $this->email=$datos['email'];
        $this->rol = $datos['rol'];
    }
    public function __get($property){
        
    }
    public function getEmail(){
        return $this->email;
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

    public function getNotFriends(){
        //esto en el constructor no xk al llamar a un nuevo usuario, el constructor llama al getNotFriends 
        //y dentro hay otro new User, por lo que cada amigo se construye como un objeto user, 
        //y esos usuarios sus amigos tbn, por lo q bucle exponencial, por eso se pone aqui
        return UserRepository::getNotFriends($this->id);
    }

    public function getFriends(){
        return UserRepository::getFriends($this->id);
    }

}
?>