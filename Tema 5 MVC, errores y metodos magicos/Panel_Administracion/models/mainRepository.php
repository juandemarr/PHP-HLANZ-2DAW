<?php
class MainRepository{
    public static function getUsers(){
        $db=Connect::connection();
        $consult=$db->query("select * from users");
        $users=array();
        while($result=$consult->fetch_assoc())
            $users[]=new UserModel($result);

        return $users;
    }

    public static function updateUser($id,$name,$email,$rol){
        $db=Connect::connection();
        $consult=$db->query("update users set name='".$name."', email='".$email."', rol='".$rol."' where id=".$id);
    }
}
?>