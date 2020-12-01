<?php

header("Content-type: text/html; charset=utf-8");

/**
 * 
 */
class Conexion
{
	
	public function conectar(){

		$localhost = "localhost";
		$database = "hardware";
		$user = "root";
		$password = "";

		$link = new PDO("mysql:host=$localhost;dbname=$database",$user,$password);

		return $link;
	}
}

?>