<?php

header("Content-type: text/html; charset=utf-8");

require_once "Conexion.php";

/**
 * 
 */
class Datos extends Conexion
{
	#USUARIO
	//-----------------------
	public function crearUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, mail, password, image, role ) 
														VALUES (:usuario, :mail, :password, :image, :role)");

		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":mail", $datosModel["mail"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":image", $datosModel["image"], PDO::PARAM_STR);
		$stmt->bindParam(":role", $datosModel["role"], PDO::PARAM_STR);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function leerUsuariosModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();

		$stmt->bindColumn("id", $id);
		$stmt->bindColumn("usuario", $usuario);
		$stmt->bindColumn("mail", $mail);
		$stmt->bindColumn("password", $password);
		$stmt->bindColumn("image", $image);
		$stmt->bindColumn("role", $role);

		$usuarios = array();

		while ($fila = $stmt->fetch(PDO::FETCH_BOUND)){
			$user = array();
			$user["id"] = utf8_encode($id);
			$user["usuario"] = utf8_encode($usuario);
			$user["mail"] = utf8_encode($mail);
			$user["password"] = utf8_encode($password);
			$user["image"] = utf8_encode($image);
			$user["role"] = utf8_encode($role);

			array_push($usuarios, $user);
		}

		return $usuarios;
	}

	public function loguearUsuarioModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE mail = :mail AND password = :password");

		$stmt->bindParam(":mail", $datosModel["mail"]);
		$stmt->bindParam(":password", $datosModel["password"]);

		$stmt->execute();

		$stmt->bindColumn("id", $id);
		$stmt->bindColumn("usuario", $usuario);
		$stmt->bindColumn("mail", $mail);
		$stmt->bindColumn("password", $password);
		$stmt->bindColumn("image", $image);
		$stmt->bindColumn("role", $role);

		while ($fila = $stmt->fetch(PDO::FETCH_BOUND)){
			$user = array();
			$user["id"] = utf8_encode($id);
			$user["usuario"] = utf8_encode($usuario);
			$user["mail"] = utf8_encode($mail);
			$user["password"] = utf8_encode($password);
			$user["image"] = utf8_encode($image);
			$user["role"] = utf8_encode($role);
		}

		if(!empty($user)){
			return $user;
		}else{
			return false;
		}
	}

	public function updateUsuarioModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla set usuario = :usuario, mail = :mail,
		 password = :password, image = :image, role = :role WHERE id = :id");
		
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
		$stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":mail", $datosModel["mail"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$stmt->bindParam(":image", $datosModel["image"], PDO::PARAM_STR);
		$stmt->bindParam(":role", $datosModel["role"], PDO::PARAM_STR);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	#EQUIPOS
	//-----------------------
	public function LeerEquiposModel($tabla){
		//$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY marca");

		$stmt = Conexion::conectar()->
		prepare("SELECT E.id , marca, modelo, descripcion, observacion, E.estado id_estado, U.estado estado, E.categoria id_categ, C.categoria
		FROM $tabla E 
		INNER JOIN estado U ON E.estado = U.id
		INNER JOIN categoria C ON E.categoria = C.id
		ORDER BY marca");

		$stmt->execute();


		$stmt->bindColumn("id", $id);
		$stmt->bindColumn("marca", $marca);
		$stmt->bindColumn("modelo", $modelo);
		$stmt->bindColumn("descripcion", $descripcion);
		$stmt->bindColumn("observacion", $observacion);
		$stmt->bindColumn("id_estado", $id_estado);
		$stmt->bindColumn("estado", $estado);
		$stmt->bindColumn("id_categ", $id_categ);
		$stmt->bindColumn("categoria", $categoria);

		$equipos = array();

		while($fila = $stmt->fetch(PDO::FETCH_BOUND)){
			$equipo = array();
			$equipo['id'] = utf8_encode($id);
			$equipo['marca'] = utf8_encode($marca);
			$equipo['modelo'] = utf8_encode($modelo);
			$equipo['descripcion'] = utf8_encode($descripcion);
			$equipo['observacion'] = utf8_encode($observacion);
			$equipo['id_estado'] = utf8_encode($id_estado);
			$equipo['estado'] = utf8_encode($estado);
			$equipo['id_categ'] = utf8_encode($id_categ);
			$equipo['categoria'] = utf8_encode($categoria);
			array_push($equipos, $equipo);

		}

		return $equipos;
	}

	public function LeerEquipoModel($_id, $tabla){
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = $_id");	
		$stmt->execute();

		$stmt->bindColumn("id", $id);
		$stmt->bindColumn("marca", $marca);
		$stmt->bindColumn("modelo", $modelo);
		$stmt->bindColumn("descripcion", $descripcion);
		$stmt->bindColumn("observacion", $observacion);
		$stmt->bindColumn("estado", $estado);
		$stmt->bindColumn("categoria", $categoria);

		$equipos = array();

		while($fila = $stmt->fetch(PDO::FETCH_BOUND)){
			$equipo = array();
			$equipo['id'] = utf8_encode($id);
			$equipo['marca'] = utf8_encode($marca);
			$equipo['modelo'] = utf8_encode($modelo);
			$equipo['descripcion'] = utf8_encode($descripcion);
			$equipo['observacion'] = utf8_encode($observacion);
			$equipo['estado'] = utf8_encode($estado);
			$equipo['categoria'] = utf8_encode($categoria);
			array_push($equipos, $equipo);
		}

		return $equipos;
	}

	public function crearEquipoModel($datosModel, $tabla){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (marca, modelo, descripcion, observacion, estado, categoria ) 
														VALUES (:marca, :modelo, :descripcion, :observacion, :estado, :categoria)");

		$stmt->bindParam(":marca", $datosModel["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datosModel["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":observacion", $datosModel["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datosModel["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":categoria", $datosModel["categoria"], PDO::PARAM_STR);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function updateEquipoModel($datosModel, $tabla){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla set marca = :marca, modelo = :modelo,
		 descripcion = :descripcion, observacion = :observacion, estado = :estado, categoria = :categoria
		WHERE id = :id");
	
		$stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_STR);
		$stmt->bindParam(":marca", $datosModel["marca"], PDO::PARAM_STR);
		$stmt->bindParam(":modelo", $datosModel["modelo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":observacion", $datosModel["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datosModel["estado"], PDO::PARAM_STR);
		$stmt->bindParam(":categoria", $datosModel["categoria"], PDO::PARAM_STR);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	#ESTADOS
	//----------------------------------------------------------------------------------
	public function leerEstadosModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT id, estado FROM $tabla");
		$stmt->execute();

		$stmt->bindColumn("id", $id);
		$stmt->bindColumn("estado", $estado);

		$estados = array();

		while ($fila = $stmt->fetch(PDO::FETCH_BOUND)){
			$cat = array();
			$cat["id"] = utf8_encode($id);
			$cat["estado"] = utf8_encode($estado);

			array_push($estados, $cat);
		}

		return $estados;
	}

	#CATEGORIAS
	//----------------------------------------------------------------------------------
	public function leerCategoriaModel($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();

		$stmt->bindColumn("id", $id);
		$stmt->bindColumn("categoria", $categoria);

		$categorias = array();

		while ($fila = $stmt->fetch(PDO::FETCH_BOUND)){
			$cat = array();
			$cat["id"] = utf8_encode($id);
			$cat["categoria"] = utf8_encode($categoria);

			array_push($categorias, $cat);
		}

		return $categorias;
	}


	public function createCategoriaModel($titulo, $tabla){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (titulo) VALUES (:titulo)");

		$stmt->bindParam(":titulo", $titulo, PDO::PARAM_STR);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	public function deleteCategoriaModel($id, $tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}

	#Componentes
	//-----------------------
	public function LeerComponentesModel($tabla){

		$stmt = Conexion::conectar()->
		prepare("SELECT C.id, equipo, titulo, C.estado id_estado, E.estado estado, descripcion, disponibilidad, hora FROM $tabla C 
		INNER JOIN estado E ON C.estado = E.id");
		
		$stmt->execute();

		$stmt->bindColumn("id", $id);
		$stmt->bindColumn("equipo", $equipo);
		$stmt->bindColumn("titulo", $titulo);
		$stmt->bindColumn("id_estado", $id_estado);
		$stmt->bindColumn("estado", $estado);
		$stmt->bindColumn("descripcion", $descripcion);
		$stmt->bindColumn("disponibilidad", $disponibilidad);
		$stmt->bindColumn("hora", $hora);

		$componentes = array();

		while($fila = $stmt->fetch(PDO::FETCH_BOUND)){
			$componente = array();
			$componente['id'] = utf8_encode($id);
			$componente['equipo'] = utf8_encode($equipo);
			$componente['titulo'] = utf8_encode($titulo);
			$componente['id_estado'] = utf8_encode($id_estado);
			$componente['estado'] = utf8_encode($estado);
			$componente['descripcion'] = utf8_encode($descripcion);
			$componente['disponibilidad'] = utf8_encode($disponibilidad);
			$componente['hora'] = utf8_encode($hora);
			array_push($componentes, $componente);

		}
		return $componentes;
	}

}

?>