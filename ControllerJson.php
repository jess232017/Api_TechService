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

		$data = new Datos();
		$respuesta = $data->crearUsuarioModel($datosController, "usuario");
		return $respuesta;
	}

	public function leerUsuariosController(){
		$data = new Datos();
		$respuesta = $data->leerUsuariosModel("usuario");
		return $respuesta;
	}

	public function loguearUsuarioController($mail, $password){

		$datosController = array("mail" => $mail,
			"password"=>$password);
			
		$data = new Datos();
		$respuesta = $data->loguearUsuarioModel($datosController, "usuario");
		
		return $respuesta;
	}

	public function updateUsuarioController($id, $usuario, $mail, $password, $image, $role){

		$datosController = array("id"=>$id,
			"usuario"=>$usuario,
			"mail"=>$mail,
			"password"=>$password,
			"image"=>$image,
			"role"=>$role);
			
			
		$data = new Datos();
		$respuesta = $data->updateUsuarioModel($datosController, "usuario");
		return $respuesta;
	}

	#equipos
	public function LeerEquiposController(){
		$data = new Datos();
		$respuesta = $data->LeerEquiposModel("equipo");
		return $respuesta;
	}
	
	//Equipo Especifico
	public function LeerEquipoController($id){
		$data = new Datos();
		$respuesta = $data->LeerEquipoModel($id ,"equipo");
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

		$data = new Datos();
		$respuesta = $data->crearEquipoModel($datosController, "equipo");
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

		$data = new Datos();
		$respuesta = $data->updateEquipoModel($datosController, "equipo");
		return $respuesta;
	}

	#Estados
	public function leerEstadosController(){
		$data = new Datos();
		$respuesta = $data->leerEstadosModel("estado");
		return $respuesta;
	}
	

	#categoria
	public function leerCategoriaController(){
		$data = new Datos();
		$respuesta = $data->leerCategoriaModel("categoria");
		return $respuesta;
	}

	public function createCategoriaController($titulo){
		$data = new Datos();
		$respuesta = $data->createCategoriaModel($titulo, "categoria");
		return $respuesta;
	}

	public function updateCategoriaController($id, $titulo){

		$datosController = array("id"=>$id,
			"titulo"=>$titulo);

		$data = new Datos();
		$respuesta = $data->updateCategoriaModel($datosController, "categoria");
		return $respuesta;
	}

	public function deleteCategoriaController($id){
		$data = new Datos();
		$respuesta = $data->deleteCategoriaModel($id, "categoria");
		return $respuesta;
	}

	#Componente
	public function leerComponentesController(){
		$data = new Datos();
		$respuesta = $data->LeerComponentesModel("componente");
		return $respuesta;
	}
}

?>