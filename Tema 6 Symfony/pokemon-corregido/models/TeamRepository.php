<?php
class TeamRepository{
    public static function addTeam($datos){
        $db=Conectar::conexion();
        //se puede controlar que no exista previamente aqui o en le controlador. O poner name como primary key
        $db->query("insert into team values('','".$datos['name']."','".$datos['idP1']."','".$datos['idP2']."','".$datos['idP3']."','".$datos['idP4']."','".$datos['idP5']."',".$_SESSION['user']->id.")");
        return $db->insert_id;//para coger el ultimo id
    }
    public static function getTeamsByUser($id){
        $db=Conectar::conexion();
        $result= $db->query("SELECT * FROM team where idUser = ".$id);
        $teams=array();
        while($datos=$result->fetch_assoc())
            $teams[]= new Team($datos);
        return $teams;
    }
}
?>