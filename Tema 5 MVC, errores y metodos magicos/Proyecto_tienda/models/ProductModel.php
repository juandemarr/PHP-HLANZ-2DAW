<?php
class Product{
    private $id;
    private $name;
    private $description;
    private $img;
    private $price;
    private $quantity;

    public function __construct($data){
        $this->id = $data['idProduct'];
        $this->name = $data['nameProduct'];
        $this->description = $data['descriptionProduct'];
        $this->img = $data['imgProduct'];
        $this->price = $data['priceProduct'];
        $this->quantity = $data['quantityProduct'];
    }
    public function __get($p){
        if(property_exists($this,$p))
            return $this->$p;
    }
}
?>