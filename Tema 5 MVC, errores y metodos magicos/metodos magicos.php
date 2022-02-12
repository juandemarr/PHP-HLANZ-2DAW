<?php
PHP_EOL //es un br de php, equivalente al salto de linea
//metodos magicos, se activan sin tener que ser llamados como los otros metodos

//METODOS MAGICOS
//https://diego.com.es/metodos-magicos-en-php

    public function __get($p){
        if(property_exists($this,$p))
            return $this->$p; //va con $ xk es el nombre de la variable que le pasa por parametro
        else if($p=="friends")
            return UserRepository::getFriends($this->id);
        else if($p=="notFriends")
            return UserRepository::getNotFriends($this->id);
    }
    //para llamarlo seria $friend->id 
    //sin ()
    //con el mismo nombre de las propiedades, sino existe con else if
    //los demas getter y setters ya no hacen falta
    
    public function __set($propiedad, $valor){
        $this->$propiedad = $valor;
    }
    $datos->noexisto = "ahora si que existo" //tbn sirve para crear propiedades 
    //ahora con array
    public function __set($nombre,$valor){
        $this->datos[$nombre] = $valor;
    }

    $datos->primero = "este es el primer elemento del array"

    public function &__get($p){} //al apuntar por referencia, solo en arrays sirve y haria de set tbn


    //////////////////////////////


    public function __isset(){
        if($this->rol>0)
            return true;
        return false;
    }
    //si se llama a un isset de este objeto, haria esto, si es de otro objeto haria su funcionamiento normal,
    // no seria sustituido por esta comprobacion de rol

    public function __unset($property){
        unset($this->property);
    }
    //actua cuando se haga un unset de una propiedad de este objeto, haria lo que se incluya dentro de este metodo

    //public function __toString() si hacemos un echo del objeto, en lugar de dar error ahora si lo va a imprimir
        //return $this->name;

    
    __sleep()
    __wakeup()
    serialize() //al hacerlo de un objeto lo conevrtiria en un array para poder usarlo como JSON.
    //cuando se llama a serialize se va al sleep() y guarda lo que se le haya indicado
    $s = serialize($_SESSION['user']);
    $o = unserialize($s);

    public function __sleep(){
        return array($this->id, $this->text)//las propiedades que queramos guardar
    }
    

    __call() llama a metodos que son protected o privated y no se podrian usar


    __clone() //se usa como palabra reservada
    $perro1 = $perro2 //al ser ambos objetos y apuntar el puntero al mismo sitio, si cambias un valor en un objeto tbn se cambia en el otro
    $perro2 = clone $perro1 //se duplica siendo dos objetos distintos

    //si al clonar un objeto, este tiene otro objeto dentro, este segundo no se duplicaria, apuntaria al mismo sitio y se habria liado.
    //Hay que clonar ese segundo tbn
    public function __clone(){
        $this->notification = clone $this->notification;
    }

    __invoke()
    //convertir un objeto en una funcion
    //x ej en array_map($objeto , $users) haria lo que tenga dentro de invoke en $objeto y lo haria en el objeto $users
    
    //se puede comprobar con el metodo is_callable($objetoCreado) //devuelve true si lo pasado puede ser 
    //llamado como una funcion
    
    
?>