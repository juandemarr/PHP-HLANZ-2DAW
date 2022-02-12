<?php
class UserRepository{
    public static function login($u,$p){
        $db = Connection::connect();
        $result = $db->query("select * from users where name = '".$u."' and password = '".md5($p)."'");
        if($data = $result->fetch_assoc())
            return new User($data);

    }

    public static function register($u,$p){
        $db = Connection::connect();
        $db->query("insert into users values('','".$u."','".md5($p)."',1)");
    }
}

?>