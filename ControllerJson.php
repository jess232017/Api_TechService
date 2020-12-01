<?php

header("Content-type: text/html; charset=utf-8");

require_once "ModeloJson.php";

/**
 * 
 */
class ControllerJson
{
	#usuario
	public function crearUsuarioController($usuario, $mail, $password, $image, $role){

		$datosController = array(
			"usuario"=>$usuario,
			"mail"=>$mail,
			"password"=>$password,
			"image"=>$image,
			"role"=>$role);

		$respuesta = Datos::crearUsuarioModel($datosController, "usuario");
		return $respuesta;
	}

	public function leerUsuariosController(){
		$respuesta = Datos::leerUsuariosModel("usuario");
		return $respuesta;
	}

	public function loguearUsuarioController($mail, $password){

		$datosController = array("mail" => $mail,
			"password"=>$password);

		$respuesta = Datos::loguearUsuarioModel($datosController, "usuario");
		
		return $respuesta;
	}

	public function updateUsuarioController($id, $usuario, $mail, $password, $image, $role){

		$datosController = array("id"=>$id,
			"usuario"=>$usuario,
			"mail"=>$mail,
			"password"=>$password,
			"image"=>$image,
			"role"=>$role);
			
		$respuesta = Datos::updateUsuarioModel($datosController, "usuario");
		return $respuesta;
	}

	#equipos
	public function LeerEquiposController(){
		$respuesta = Datos::LeerEquiposModel("equipo");
		return $respuesta;
	}
	
	//Equipo Especifico
	public function LeerEquipoController($id){
		$respuesta = Datos::LeerEquipoModel($id ,"equipo");
		return $respuesta;
	}

	public function crearEquipoController($marca, $modelo, $descripcion, $observacion, $estado, $categoria){

		$datosController = array(
			"marca"=>$marca,
			"modelo"=>$modelo,
			"descripcion"=>$descripcion,
			"observacion"=>$observacion,
			"estado"=>$estado,
			"categoria"=>$categoria);

		$respuesta = Datos::crearEquipoModel($datosController, "equipo");
		return $respuesta;
	}

	public function EditarEquipoController($id, $marca, $modelo, $descripcion, $observacion, $estado, $categoria){

		$datosController = array(
			"id"=>$id,
			"marca"=>$marca,
			"modelo"=>$modelo,
			"descripcion"=>$descripcion,
			"observacion"=>$observacion,
			"estado"=>$estado,
			"categoria"=>$categoria);

		$respuesta = Datos::updateEquipoModel($datosController, "equipo");
		return $respuesta;
	}

	#Estados
	public function leerEstadosController(){
		$respuesta = Datos::leerEstadosModel("estado");
		return $respuesta;
	}
	

	#categoria
	public function leerCategoriaController(){
		$respuesta = Datos::leerCategoriaModel("categoria");
		return $respuesta;
	}

	public function createCategoriaController($titulo){
		$respuesta = Datos::createCategoriaModel($titulo, "categoria");
		return $respuesta;
	}

	public function updateCategoriaController($id, $titulo){

		$datosController = array("id"=>$id,
			"titulo"=>$titulo);

		$respuesta = Datos::updateCategoriaModel($datosController, "categoria");
		return $respuesta;
	}

	public function deleteCategoriaController($id){
		$respuesta = Datos::deleteCategoriaModel($id, "categoria");
		return $respuesta;
	}

	#Componente
	public function leerComponentesController(){
		$respuesta = Datos::LeerComponentesModel("componente");
		return $respuesta;
	}
}

?>