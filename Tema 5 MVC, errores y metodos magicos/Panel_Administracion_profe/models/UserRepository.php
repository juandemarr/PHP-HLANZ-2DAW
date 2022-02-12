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
        //si esta "eliminado para el usuario" debe dejar registrarse con ese nombre, aunque siga estando en la bd
        $result1=$db->query("SELECT * FROM users WHERE username='".$u."' and visible = 0");
        if($datos=$result1->fetch_assoc()){
            $result2= $db->query("insert into `users` values ('','".$u."','".md5($p)."','1','".$e."',1)");
            //echo "insert into `users` values ('','".$u."','".$p."','1','".$e."',1)";
        }else{
            $result2= $db->query("insert into `users` values ('','".$u."','".md5($p)."','1','".$e."',1)");
            //echo "insert into `users` values ('','".$u."','".$p."','1','".$e."',1)";
        }
    }

    public static function list(){
        $db=Conectar::conexion();
        $result= $db->query("SELECT * FROM users where visible=1");
        $users=NULL;
        while($datos=$result->fetch_assoc())
            $users[]= new User($datos);//no hay que declararla antes porque en este caso siempre hay usuarios
            //De no haber siempre si hay que declararla antes
        return $users;
    }

    public static function admin($id,$rol){
        $db=Conectar::conexion();
        $result=$db->query("UPDATE users SET rol=".$rol." WHERE id=".$id."");
    }

    public static function getUserById($id){
        $db=Conectar::conexion();
        $result= $db->query("SELECT * FROM users WHERE visible=1 and id = ".$id);
        if($datos=$result->fetch_assoc())
            return new User($datos);
    }

    public static function save($id,$u,$e){
        $db=Conectar::conexion();
        $result=$db->query("UPDATE users SET username='".$u."',email='".$e."' WHERE id=".$id);
        //echo "UPDATE users SET username='".$u."',email='".$e."' WHERE id=".$id;//para mostrar la sentencia
    }

    public static function delete($id){
        $db=Conectar::conexion();
        //$result=$db->query("DELETE FROM users where id=".$id);
        //Borrado logico, no se muestra el usuario pero sigue en la bd, se le añade una columna hidden a 1 o 2, 
        //para mostrar o no
        $result=$db->query("UPDATE users set visible=0 where id=".$id);
    }

    public static function getNotFriends($id){
        $db = Conectar::conexion();
        $f=array();
        if($result = $db->query("select * from users where id != ".$id." and
        visible = 1 and 
        (id not in (select idUser2 from friends where idUser1 = ".$id.")
        and id not in (select idUser1 from friends where idUser2 = ".$id."))"))
            while($row=$result->fetch_assoc())
                $f[]=new User($row);

        return $f;
    }

    public static function getFriends($id){
        //al ser ambos id clave primaria en la bd, se evitan los duplicados
        $db = Conectar::conexion();
        $f=array();
        if($result = $db->query("select * from users where id != ".$id." and
        visible = 1 and  
        (id in (select idUser2 from friends where idUser1 = ".$id.")
        or id in (select idUser1 from friends where idUser2 = ".$id."))"))
            while($row=$result->fetch_assoc())
                $f[]=new User($row);

        return $f;
    }

    public static function addFriend($id){
        $db=Conectar::conexion();
        $result=$db->query("insert into friends values(".$_SESSION['user']->getId().",".$id.")");
    }

    public static function delFriend($id){
        $db=Conectar::conexion();
        $result=$db->query("delete from friends where (idUser1 = ".$_SESSION['user']->getId()." 
        and idUser2 = ".$id.") or (idUser2 = ".$_SESSION['user']->getId()." 
        and idUser1 = ".$id.")");
    }
}
?>