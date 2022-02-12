<?php
class User{
    private $id;
    private $name;
    private $email;
    private $rol;
    //private $data; //__set() con valor
    //private $data = array();//__set() con arrays
    //public $string = "hola"; //__toString()
    //private $balon = "balon";

    public function __construct($datos){
        $this->id = $datos['id'];
        $this->name = $datos['username'];
        $this->email=$datos['email'];
        $this->rol = $datos['rol'];
    }
    public function __get($property){
        if(property_exists($this,$property))
            return $this->$property;
        /* else if($property=="friends")
            return UserRepository::getFriends($this->id);
        else if($property=="notfriends")
            return UserRepository::getNotFriends($this->id); 
        */
        //en lugar de crear la funcion con el contenido de la linea UserRepository
    }
    //__set() con valor
    /*  public function __set($propiedad,$valor){
        $this->$propiedad = $valor;
    } */

    //__set() con arrays
    /* public function __set($propiedad,$valor){
        $this->data[$propiedad] = $valor;
    } */

    //__&__get($valor)
    /*public function &__get($valor){
        return $this->$valor;
    }*/

    //__toString()
    /*public function __toString(){
        //return "hola";
        return $this->string;
    }*/

    //__isset($propiedad)
    /*public function __isset($propiedad){
        return isset($this->$propiedad);
    }*/

    //__unset($propiedad)
    /* public function __unset($propiedad){
        unset($this->$propiedad);
    } */

    //__sleep() y __wakeup() Cuidado con esto dos que impiden crearse el objeto e iniciar sesion
    /*public function __sleep(){
        return array('id','name');//se le pasan los nombres de las propiedades a guardar y siempre devuelve un array
    }*/
    /*public function __wakeup(){
        $this->email;
    }*/

    //__invoke()
    /*public function __invoke($mensaje){
        return $mensaje;
    }*/

    //__clone()
    /*public function __clone(){//tiene que ser sobre objetos
        $this->role = clone $this->role;
    }*/

}
?>