<?php
class UserRepository{

    public static function login($u,$p){
        $db = Conectar::conexion();
        $result = $db->query("select * from users where name = '".$u."' and password = '".md5($p)."'");
        if($data = $result->fetch_assoc())
            return new User($data);

    }

    public static function register($u,$p,$email){
        $db = Conectar::conexion();
        $db->query("insert into users values('','".$u."','".md5($p)."','".$email."',1)");
    }

    public static function getUserById($id){
        $db=Conectar::conexion();
        $result= $db->query("SELECT * FROM users WHERE id = ".$id);
        if($datos=$result->fetch_assoc())
            return new User($datos);
    }

}
?>