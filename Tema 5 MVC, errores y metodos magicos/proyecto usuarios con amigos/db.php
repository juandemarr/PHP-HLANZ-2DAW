<?php
class Conectar{
    public static function conexion(){
        $db = new mysqli("localhost", "root", "", "paneladministracionprofe");
        $db->query("set names 'utf8'");
        return $db;
    }
}
?>