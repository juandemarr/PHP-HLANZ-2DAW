<?php
class UserRepository{
    public static function login($name,$password){
        $db=Connect::connection();
        $consult=$db->query("select * from users where name='".$name."' and password='".md5($password)."'");
        if($result=$consult->fetch_assoc())
            return new UserModel($result);
    }

    public static function register($name,$password,$email){
        $db=Connect::connection();
        $consult=$db->query("insert into users values('','".$name."','".md5($password)."','".$email."',1)");//rol 1 para usuarios
    }
}
?>