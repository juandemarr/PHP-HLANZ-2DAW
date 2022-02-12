<?php
class Connect{
    public static function connection(){
        $db=new mysqli("localhost","root","","paneladministracion");
        $db->query("set names 'utf8'");
        return $db;
    }
}
?>