<?php
class Order{
    private $id;
    private $idUser;
    private $date;
    private $numberProducts;
    private $totalPrice;

    public function __construct($data){
        $this->id = $data['id'];
        $this->idUser = $data['idUser'];
        $this->date = $data['date'];
        $this->numberProducts = $data['numberProducts'];
        $this->totalPrice = $data['totalPrice'];
    }
    public function __get($p){
        if(property_exists($this,$p))
            return $this->$p;
    }
}
?>