<?php
class CartProduct{
    private $id;
    private $name;
    private $img;
    private $price;
    private $quantity;

    public function __construct($data){
        $this->id = $data['idProduct'];
        $this->name = $data['nameProduct'];
        $this->img = $data['imgProduct'];
        $this->price = $data['priceProduct'];
        $this->quantity = $data['quantityCart'];
    }
    public function __get($p){
        if(property_exists($this,$p))
            return $this->$p;
    }
}
?>