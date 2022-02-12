<?php
class Conectar{
    public static function conexion(){
        $conexion=new mysqli("localhost", "root", "", "paneladministracionprofe");
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}
?>