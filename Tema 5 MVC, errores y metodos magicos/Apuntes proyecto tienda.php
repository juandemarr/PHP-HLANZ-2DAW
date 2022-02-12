<?php
class User{
    dentro de una funcion init($user,$pass){
        aqui hago lo del repositoryUser, consulta a bd para comprobar y dentro del fetch_assoc()
        inicializo todas las variables
    }
}
en el mainController, si recibo cart solo hace require_once(cartView.phtml)
En la vista poner todo dentro de un isset $_SESSION['user']

El lo tiene mezclado en la tabla pedidos, con una columna state a 'cart' ya que el carrito 
seria un pedido sin finalizar


No hace fallta crear este array de quantities
$this->quantities[$p['id']] = $p['quantity']; Dentro del while de la consulta que coge 
todos los productos y la cantidad de la linea de pedido. Dentro del constructor de cart, donde se crean
los dos arrays de product y quantities

$db->insert_id devuelve el ultimo id insertado

/////////////////////
class Order{
    $orderLines[];
    $id
    $total
    $fecha

    public function __construct(){
        $id=$datos['id']
        $total=$datos['total']
        $fecha=$datos['fecha']
        $orderLines=orderLinesRepository::getLinesByOrder($id);
    }
    add()

}

class OrderLines{
    $id
    $quantity
    $idProduct

    public function __construct($datos){
        $quantity = $datos['quantity'];
        $product = new Product ($datos);
    }
}
?>
