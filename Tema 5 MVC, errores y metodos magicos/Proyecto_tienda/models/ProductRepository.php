<?php
class ProductRepository{
    public static function addProduct($name,$desc,$img,$price,$quantity){
        $db = Connection::connect();
        $db->query("insert into products values('','".$name."','".$desc."','".$img."',".$price.",".$quantity.")");
    }
    public static function editProduct($id,$name,$desc,$img,$price,$quantity){
        $db = Connection::connect();
        $db->query("update products set nameProduct = '".$name."',descriptionProduct = '".$desc."',
        imgProduct = '".$img."',priceProduct = ".$price.",quantityProduct = ".$quantity." where idProduct = ".$id);
    }
    public static function deleteProduct($id){
        $db = Connection::connect();
        $db->query("delete from products where idProduct = ".$id);
    }
    public static function listProducts(){
        $db = Connection::connect();
        $products = array();
        $result = $db->query("select * from products");
        while($data = $result->fetch_assoc())
            $products[] = new Product($data);
        return $products;
    }
    public static function listProductById($id){
        $db = Connection::connect();
        $result = $db->query("select * from products where idProduct = ".$id);
        if($data = $result->fetch_assoc())
            return new Product($data);
    }
    public static function checkQuantity($id){
        $db = Connection::connect();
        $result = $db->query("select quantityProduct from products where idProduct = ".$id);
        if($data = $result->fetch_row())
            return $data[0]>0;
    }
    public static function updateQuantity($id,$quantity){
        $db = Connection::connect();
        $db->query("update products set quantityProduct = quantityProduct - ".$quantity." where idProduct = ".$id);
    }
}
?>