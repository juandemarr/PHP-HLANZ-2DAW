<?php
class Connection{
    public static function connect(){
        $db = new mysqli("localhost", "root", "", "examenJuande");
        $db->query("set names 'utf8'");
        return $db;
    }
}
?>