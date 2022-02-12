<?php
class CartRepository{
    public static function listCart(){
        $db = Connection::connect();
        $cartProducts = array();
        $result = $db->query("select * from cart");
        while($data = $result->fetch_assoc())
            $cartProducts[] = new CartProduct($data);
        return $cartProducts;
    }
    public static function existsProductCart($id){
        $db = Connection::connect();
        $result = $db->query("select * from cart where idProduct = ".$id);
        if($data = $result->fetch_assoc())
            return true;
        else return false;
    }
    public static function addCart($idUser,$idProduct,$nameP,$imgP,$priceP,$quantityP){
        $db = Connection::connect();
        $db->query("insert into cart values('',".$idUser.",".$idProduct.",'".$nameP."','".$imgP."','".$priceP."','".$quantityP."')");
    }
    public static function updateQuantity($idP,$priceP){
        $db = Connection::connect();
        $db->query("update cart set quantityCart = quantityCart + 1 , priceProduct = priceProduct + ".$priceP." where idProduct = ".$idP);
    }
    public static function deleteCart(){
        $db = Connection::connect();
        $db->query("delete from cart");
    }
    public static function numberProducts(){
        $db = Connection::connect();
        $result = $db->query("select sum(quantityCart) from cart");
        if($data = $result->fetch_row()) //fetch_row() devuelve un array numerico empezando por 0
            return $data[0];
    }
    public static function totalPrice(){
        $db = Connection::connect();
        $result = $db->query("select sum(priceProduct) from cart");
        if($data = $result->fetch_row())
            return $data[0];
    }
    
}
?>