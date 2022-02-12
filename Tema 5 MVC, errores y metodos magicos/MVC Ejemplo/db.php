<?php
class Conectar{
    public static function conexion(){//metodo estatico, no hay que crearle una instancia (objeto con new) para llamarla
        $conexion=new mysqli("localhost", "root", "", "daw");
        $conexion->query("SET NAMES 'utf8'");
        return $conexion;
    }
}
?>