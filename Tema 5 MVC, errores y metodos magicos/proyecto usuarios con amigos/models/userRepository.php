<?php
class UserRepository{
    public static function login($u,$p){
        $db=Conectar::conexion();
        $result= $db->query("SELECT * FROM users WHERE username = '".$u."' and password = '".md5($p)."' and visible=1");
        if($datos=$result->fetch_assoc())
            return new User($datos);
    }

    public static function register($u,$p,$e){
        $db=Conectar::conexion();
        $result1=$db->query("SELECT * FROM users WHERE username='".$u."' and visible = 0");
        if($datos=$result1->fetch_assoc()){
            $result2= $db->query("insert into `users` values ('','".$u."','".md5($p)."','1','".$e."',1)");
        }else{
            $result2= $db->query("insert into `users` values ('','".$u."','".md5($p)."','1','".$e."',1)");
        }
    }

    public static function list(){
        $db=Conectar::conexion();
        $result= $db->query("SELECT * FROM users where visible=1");
        $users=NULL;
        while($datos=$result->fetch_assoc())
            $users[]= new User($datos);
        return $users;
    }
    public static function friends($user1){
        $db=Conectar::conexion();
        $result = $db->query("select * from users, friends where (users.id = friends.idUser2
            and friends.idUser1 = ".$user1.") or (users.id = friends.idUser1 and friends.idUser2 = ".$user1.")");
        $friends=array();
        while($data = $result->fetch_assoc())
            $friends[]=new User($data);
        return $friends;
    }
    public static function noFriends($user1){
        $db=Conectar::conexion();
        $result = $db->query("select * from users where visible > 0 and id not in(select id from users, friends where (users.id = friends.idUser2
        and friends.idUser1 = ".$user1.") or (users.id = friends.idUser1 and friends.idUser2 = ".$user1.") or id = ".$user1.")");
        $noFriends = array();
        while($data = $result->fetch_assoc())
            $noFriends[]=new User($data);
        return $noFriends;
    }
    public static function add($idMio,$id2){
        $db=Conectar::conexion();
        $db->query("insert into friends values(".$idMio.",".$id2.")");
    }
    public static function delete($idMio){
        $db=Conectar::conexion();
        $db->query("delete from friends where idUser1 = ".$idMio);
    }

}
?>