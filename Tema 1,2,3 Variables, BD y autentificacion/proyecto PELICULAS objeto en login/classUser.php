<?php
class User{
    private $id;
    private $username;
    private $password;
    private $rol;
    private $email;

    public function __construct($row){
        //pasarle usuario, contraseña y los datos a comprobar.
        //Aqui dentro hacer todas las comprobaciones. La contraseña no se guarda
        $this->id = $row['id'];
        $this->username = $row['username'];
        $this->password = $row['password'];
        $this->rol = $row['rol'];
        $this->email = $row['email'];

    }

    public function check($nombrePost, $passPost){
        return ($this->username == $nombrePost && $this->password == $passPost);
    }

    public function getId(){
        return $this->id;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getRol(){
        return $this->rol;
    }
    public function getEmail(){
        return $this->email;
    }
}

?>