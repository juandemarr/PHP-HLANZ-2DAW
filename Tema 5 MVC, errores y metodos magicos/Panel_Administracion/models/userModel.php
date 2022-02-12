<?php
class UserModel{
    private $id;
    private $name;
    private $email;
    private $rol;

    public function __construct($data){
        $this->id=$data['id'];
        $this->name=$data['name'];
        $this->email=$data['email'];
        $this->rol=$data['rol'];
    }

    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getRol(){
        return $this->rol;
    }

    public function setName($name){
        $this->name=$name;
    }
    public function setEmail($email){
        $this->email=$email;
    }
    public function setRol($rol){
        $this->rol=$rol;
    }

}
?>