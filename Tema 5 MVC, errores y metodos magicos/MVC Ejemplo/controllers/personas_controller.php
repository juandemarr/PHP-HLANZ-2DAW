<?php
//Llamada al modelo
require_once("models/personas_model.php");//no hay que poner .. ya que siempre se parte desde index.php, la raiz
//usar el modelo
$per=new personas_model();//llamada al constructor
$datos=$per->get_personas();


 
//Llamada a la vista
require_once("views/personas_view.phtml");//todo el contenido del archivo estaria aqui,
// por eso alli se puede husar $datos, creado aqui
?>