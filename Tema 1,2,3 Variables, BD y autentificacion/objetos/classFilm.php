<?php

class Movie{
    private $id;
    private $title;
    private $year;
    private $poster;

    //constructor recibe array asociativo desde fetch_assoc
    public function __construct($row){
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->year = $row['year'];
        $this->poster = $row['poster'];

    }

    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getYear(){
        return $this->year;
    }
    public function getPoster(){
        return $this->poster;
    }

    public function setTitle($title){
        $this->title = $title;
    }
    public function setYear($year){
        $this->year = $year;
    }
    public function setPoster($poster){
        $this->poster = $poster;
    }

}

?>