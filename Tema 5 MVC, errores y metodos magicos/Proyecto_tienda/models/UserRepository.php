<?php
class UserRepository{
    public static function login($u,$p){ //rol 0 is for the "elimnated" users
        $db = Connection::connect();
        $result = $db->query("select * from users where nameUser = '".$u."' and password = '".md5($p)."' and rol != 0");
        if($data = $result->fetch_assoc())
            return new User($data);
            
    }
    public static function register($u,$p,$email){
        $db = Connection::connect();
        $db->query("insert into users values('','".$u."','".md5($p)."','".$email."',1)");
    }
    public static function listUsers(){
        $db = Connection::connect();
        $users = array();
        $result = $db->query("select * from users");
        while($data = $result->fetch_assoc()){
            $users[] = new User($data);
        }
        return $users;
    }
    public static function resetPassword($id,$p){
        $db = Connection::connect();
        $db->query("update users set password = '".md5($p)."' where idUser = ".$id);
    }
    public static function deleteUser($id){
        $db = Connection::connect();
        $db->query("update users set rol = 0 where idUser = ".$id);
    }
    public static function activateUser($id){
        $db = Connection::connect();
        $db->query("update users set rol = 1 where idUser = ".$id);
    }
}
?>