<?php
    class Connect{
        public static function connection(){
            $conection = new mysqli("localhost","root","","proyectopeliculas");
            $conection->query("set names 'utf-8'");
            return $conection;
        }
    }
?>