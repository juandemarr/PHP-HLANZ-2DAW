<?php
class Pokemon{
    private $name;
    private $type;
    private $img;

    public function __construct($data){
        $this->name = $data['name'];
        $this->type = $data['type'];
        $this->img = $data['img'];
    }
    public function __get($p){
        if(property_exists($this,$p))
            return $this->$p;
    }

}
?>