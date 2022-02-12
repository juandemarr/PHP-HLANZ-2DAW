<?php

/**
 * 
 */
class PeliModel 
{
	private $id;
	private $title;
	private $year;
	private $image;
	private $likes;
	
	function __construct($datos)
	{
		$this->id=$datos['id'];
		$this->title=$datos['title'];
		$this->year=$datos['year'];
		$this->image=$datos['poster'];
		$this->likes=$datos['likes'];
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
	public function getImage(){
		return $this->image;
	}
	public function getLikes(){
		return $this->likes;
	}
	//Camino dificil de añadir like, en lugar de hacer el update en el metodo del repositorio, lo añadimos aqui
	public function addLike($cantidad){
		$db=Conectar::conexion();
		$result=$db->query("update films set likes = likes + ".$cantidad." where id=".$this->id);
		$db->close();
	}

	/* public function addDislike(){
		$db=Conectar::conexion();
		if($result=$db->query("update films set likes = likes -1 where id=".$this->id))
			return true;
		return false;
	} */
}

?>