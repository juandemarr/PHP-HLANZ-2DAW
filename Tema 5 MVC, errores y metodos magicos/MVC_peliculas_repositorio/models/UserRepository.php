<?php
class UserRepository{

    public static function login($u,$p){
        $db=Conectar::conexion();
        $result= $db->query("SELECT * FROM users WHERE username = '".$u."' and password = '".$p."'");
        //Se compara la contraseña encriptada guardada con la contraseña que escriba y se encripta previamente
        if($datos=$result->fetch_assoc())
            return new User($datos);
    }

    public static function register($u,$p){
        $db=Conectar::conexion();
        $result= $db->query("insert into `users` values ('','".$u."','".$p."','1','".$_POST['email']."')");//para encriptar md5($p).
        
        //no dejar la sesion iniciada al registrar el usuario, ya que se lo puede inventar y tendria acceso a todo, 
        //lo normal es enviar correo de verificacion para poder loguearse. 
        //En este caso, no se queda logueado y tienen que hacerlo.
        /*
        $result2=$db->query("SELECT * FROM users WHERE username = '".$u."' and password = '".$p."'");
        if($datos=$result2->fetch_assoc())
            return new User($datos);
        */
    }
}
?>