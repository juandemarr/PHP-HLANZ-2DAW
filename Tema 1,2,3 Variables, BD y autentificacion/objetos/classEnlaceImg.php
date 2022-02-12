<?php
    class Enlace {
        //public private, protected (heredable). A partir de php 7 existen los tipos
        public $url;
        public $img;

        public function __construct($u,$i){//metodos que empiezan por dos barras bajas son los del sistema, predefinidos
            $this->url = $u;
            $this->img = $i;
        } 

    }
?>