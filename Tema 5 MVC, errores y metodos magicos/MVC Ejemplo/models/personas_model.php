<?php
class personas_model{//aqui se hace la conexion y las consultas, en metodos de la clase
    private $db;
    private $personas;
 
    public function __construct(){
        $this->db=Conectar::conexion();//con :: se llama a un metodo estatico
        $this->personas=array();
    }
    public function get_personas(){
        $result=$this->db->query("select * from productos;");//$this->db equivale a $mysqli, una vez creado en db.php con new
        while($row=$result->fetch_assoc()){
            $this->personas[]=$row;
        }
        return $this->personas;
    }
}
?>