<?php
class Connection{
    public static function connect(){
        $db = new mysqli("localhost", "root", "", "proyectotienda", "3307");
        $db->query("set names 'utf8'");
        return $db;
    }
}
?>
