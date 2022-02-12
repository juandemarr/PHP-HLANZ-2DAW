<?php
class Pokemon{
    private $id;
    private $name;
    private $type;
    private $image;

    public function __construct($data){
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->type = $data['type'];
        $this->image = $data['image'];
    }
    public function __get($p){
        if(property_exists($this,$p))
            return $this->$p;
    }
    public function __toString(){
        return $this->name;
    }
}
?>