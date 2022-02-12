<?php
    class filmModel{
        private $db;
        private $allFilms;

        public function __construct(){
            $this->db = Connect::connection();
            $this->allFilms = array();

        }

        public function getFilms(){
            $result = $this->db->query("select * from films");
            while($row = $result->fetch_assoc())
                $this->allFilms[] = $row;
            
            return $this->allFilms;
        }

        public function addLike($id){
            if(!$result = $this->db->query("update films set likes = likes + 1 where id = ".$id))
                return false;
            else return true;
        }

        public function getFilmDetail($id){
            $result = $this->db->query("select * from films where id = ".$id);
            if($row = $result->fetch_assoc())
                return $row;
            
            else return null;
        }
    }
?>