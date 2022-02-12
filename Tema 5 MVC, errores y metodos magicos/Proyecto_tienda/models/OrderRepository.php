<?php
class OrderRepository{
    public static function createOrder($idUser,$date,$numberP,$totalPrice){
        $db = Connection::connect();
        $db->query("insert into orders values('',".$idUser.",'".$date."',".$numberP.",".$totalPrice.")");
    }
    public static function deleteOrder($id){
        $db = Connection::connect();
        $db->query("delete from orders where id = ".$id);
    }
    public static function createDetailOrder($idUser,$actualDate){
        $db = Connection::connect();
        //Cojo idOrder
        $result = $db->query("select id from orders where idUser = ".$idUser." and date = '".$actualDate."'");
        if($idOrder = $result->fetch_row()){
            //Cojo idProduct y quantity para rellenar cada linea de productorder
            $dataProduct = $db->query("select idProduct from cart");
            $dataQuantity = $db->query("select quantityCart from cart");
            while($idProduct = $dataProduct->fetch_row() and $quantity = $dataQuantity->fetch_row()){
                //checkeo quantity del producto (stock)
                if(ProductRepository::checkQuantity($idProduct[0])){
                    $db->query("insert into productorder values('',".$idOrder[0].",".$idProduct[0].",".$quantity[0].")");
                    ProductRepository::updateQuantity($idProduct[0],$quantity[0]);
                }else{
                    //elimino idOrder de orders creada antes
                    //siendo idOrder y idProduct foreign key on delete cascade, eliminando idOrder en orders
                    //elimina las lineas de productorders insertadas antes
                    self::deleteOrder($idOrder[0]);//para llamar a una funcion dentro de la misma clase
                    break;
                }
                
                
            }
        }
    }
    public static function listOrders(){
        $db = Connection::connect();
        $orders = array();
        $result = $db->query("select * from orders");
        while($data = $result->fetch_assoc())
            $orders[] = new Order($data);
        return $orders;
    }
}
?>