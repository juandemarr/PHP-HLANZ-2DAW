<?php

/**
 * Siempre tendrá métodos estáticos, se crean las funciones de los que nos pidan obtener sobre conjuntos de datos, 
 * sobre la clase del objeto individual, creada en otro modelo
 */
class PeliRepository
{
	//metodo para sacar todas las peliculas
	public static function getMovies(){
		$db=Conectar::conexion();
		$movies= array();
		$result= $db->query("SELECT * FROM films");
		while($row=$result->fetch_assoc()){
			$movies[]=new PeliModel($row);
		}
		return $movies;
	}

	public static function getMovieByTitle($t){
		$db=Conectar::conexion();
		$movies= array();
		$result= $db->query("SELECT * FROM films WHERE title LIKE '%".$t."%'");//% indica que puede haber lo que sea en esa posicion
		while($row=$result->fetch_assoc()){
			$movies[]=new PeliModel($row);
		}
		return $movies;
	}
	/*Camino facil de añadir like
	public static function addLike($id){
		$db=Conectar::conexion();
		$result=$db->query("update films set likes = likes + 1 where id=".$id);
	}*/

	//Camino dificil de añadir like. Meter funcion de addLike en peliModel

	public static function getMovieById($id){
		$db=Conectar::conexion();
		$result= $db->query("SELECT * FROM films WHERE id = ".$id);
		/*if($row=$result->fetch_assoc())
			return new PeliModel($row);
		return false;*/
		return new PeliModel($result->fetch_assoc());
	}

	public static function orderByYear($formaOrdenar){
		$db=Conectar::conexion();
		$result= $db->query("select * from films order by year ".$formaOrdenar);
		$movies= array();
		while($row=$result->fetch_assoc()){
			$movies[]=new PeliModel($row);
		}
		return $movies;
	}

	public static function getMoviesByYear($year){
		$db=Conectar::conexion();
		$movies= array();
		$result= $db->query("SELECT * FROM films where year = ".$year);
		while($row=$result->fetch_assoc()){
			$movies[]=new PeliModel($row);
		}
		return $movies;
	}
}


?>