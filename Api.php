<?php

header("Content-type: text/html; charset=utf-8");

require_once 'ControllerJson.php';

//función validando todos los parametros disponibles
//pasaremos los parámetros requeridos a esta función

function isTheseParametersAvailable($params){
	//suponiendo que todos los parametros estan disponibles
	$available = true;
	$missingparams = "";

	foreach ($params as $param) {
		if(!isset($_POST[$param]) || strlen($_POST[$param]) <= 0){
			$available = false;
			$missingparams = $missingparams . ", " . $param;
		}
	}

	//si faltan parametros
	if(!$available){
		$response = array();
		$response['error'] = true;
		$response['message'] = 'Parametro' . substr($missingparams, 1, strlen($missingparams)) . ' vacio';

		//error de visualización
		echo json_encode($response);

		//detener la ejecición adicional
		die();
	}
}

//una matriza para mostrar las respuestas de nuestro api
$response = array();

//si se trata de una llamada api
//que significa que un parametro get llamado se establece un la URL
//y con estos parametros estamos concluyendo que es una llamada api

if(isset($_GET['apicall'])){

	//Aqui iran todos los llamados de nuestra api
	switch ($_GET['apicall']) {

		///Operaciones de usuario
		case 'crear_usuario':
			//primero haremos la verificación de parametros.
			isTheseParametersAvailable(array('usuario', 'mail', 'pass', 'image', 'role'));

			$db = new ControllerJson();

			$result = $db->crearUsuarioController(
				$_POST['usuario'],
				$_POST['mail'],
				$_POST['pass'],
				$_POST['image'],
				$_POST['role']);

			if($result){

				//esto significa que no hay ningun error
				$response['error'] = false;
				//mensaje que se ejecuto correctamente
				$response['message'] = 'usuario agregado correctamente';

				//$response['contenido'] = $db->LeerEquiposController();
			}else{
				$response['error'] = true;
				$response['message'] = 'ocurrio un error, intenta nuevamente';
			}
			break;

		case 'leer_usuarios':
			$db = new ControllerJson();
			$response['error'] = false;
			$response['message'] = 'solicitud completada correctamente';
			$response['contenido'] = $db->leerUsuariosController();
			break;

		case 'leer_usuario':

			isTheseParametersAvailable(array('mail', 'pass'));

			$db = new ControllerJson();

			$result = $db->loguearUsuarioController($_POST['mail'],
				$_POST['pass']);

			if(!$result){
				$response['error'] = true;
				$response['message'] = 'Credenciales no validas';
			}else{

				$response['error'] = false;
				$response['message'] = 'Bienvenido de nuevo';
				$response['contenido'] = $result;
			}
			break;
		
		case 'edit_usuario':

			//primero haremos la verificación de parametros.
			isTheseParametersAvailable(array('id','usuario', 'mail', 'pass', 'mage', 'role'));

			$db = new ControllerJson();

			$result = $db->updateUsuarioController(
				$_POST['id'],
				$_POST['usuario'],
				$_POST['mail'],
				$_POST['pass'],
				$_POST['mage'],
				$_POST['role']);
	
			if($result){
				//esto significa que no hay ningun error
				$response['error'] = false;	
				//mensaje que se ejecuto correctamente
				$response['message'] = 'Usuario editado correctamente';
			}else{
				$response['error'] = true;
				$response['message'] = 'ocurrio un error, intenta nuevamente';
			}
	
			break;

		///Operaciones de equipo
		case 'leer_equipos':
			$db = new ControllerJson();
			$response['error'] = false;
			$response['message'] = 'solicitud completada correctamente';
			$response['contenido'] = $db->LeerEquiposController();
			break;

		case 'leer_equipo':
			isTheseParametersAvailable(array('id'));

			$db = new ControllerJson();

			$result = $db->LeerEquipoController($_POST['id']);

			if(!$result){
				$response['error'] = true;
				$response['message'] = 'Equipo no encontrado';
				$response['contenido'] = $result;
			}else{

				$response['error'] = false;
				$response['message'] = 'solicitud completada correctamente';
				$response['contenido'] = $result;
			}
			
			break;

		case 'crear_equipo':
			//primero haremos la verificación de parametros.
			isTheseParametersAvailable(array('marca', 'modelo', 'descripcion', 'observacion', 'estado', 'categoria'));

			$db = new ControllerJson();

			$result = $db->crearEquipoController(
				$_POST['marca'],
				$_POST['modelo'],
				$_POST['descripcion'],
				$_POST['observacion'],
				$_POST['estado'],
				$_POST['categoria']);

			if($result){

				//esto significa que no hay ningun error
				$response['error'] = false;
				//mensaje que se ejecuto correctamente
				$response['message'] = 'equipo agregado correctamente';

				//$response['contenido'] = $db->LeerEquiposController();
			}else{
				$response['error'] = true;
				$response['message'] = 'ocurrio un error, intenta nuevamente';
			}
			break;

		case 'editar_equipo':
			//primero haremos la verificación de parametros.
			isTheseParametersAvailable(array('id', 'marca', 'modelo', 'descripcion', 'observacion', 'estado', 'categoria'));

			$db = new ControllerJson();

			$result = $db->EditarEquipoController(
				$_POST['id'],
				$_POST['marca'],
				$_POST['modelo'],
				$_POST['descripcion'],
				$_POST['observacion'],
				$_POST['estado'],
				$_POST['categoria']);

			if($result){

				//esto significa que no hay ningun error
				$response['error'] = false;
				//mensaje que se ejecuto correctamente
				$response['message'] = 'equipo editado correctamente';

				//$response['contenido'] = $db->LeerEquiposController();
			}else{
				$response['error'] = true;
				$response['message'] = 'ocurrio un error, intenta nuevamente';
			}
			break;

		//operacion LeerEstados
		case 'leer_estado':
			$db = new ControllerJson();
			$response['error'] = false;
			$response['message'] = 'solicitud completada correctamente';
			$response['contenido'] = $db->leerEstadosController();
			break;
			
		//operacion Categoria
		case 'leer_categoria':
			$db = new ControllerJson();
			$response['error'] = false;
			$response['message'] = 'solicitud completada correctamente';
			$response['contenido'] = $db->leerCategoriaController();
			break;

		case 'createcategoria':

			//primero haremos la verificación de parametros.
			isTheseParametersAvailable(array('titulo'));

			$db = new ControllerJson();

			$result = $db->createCategoriaController($_POST['titulo']);

			if($result){

				//esto significa que no hay ningun error
				$response['error'] = false;
				//mensaje que se ejecuto correctamente
				$response['message'] = 'categoria agregada correctamente';

				$response['contenido'] = $db->readCategoriasController();
			}else{
				$response['error'] = true;
				$response['message'] = 'ocurrio un error, intenta nuevamente';
			}

			break;

		case 'updatecategoria':

			//primero haremos la verificación de parametros.
			isTheseParametersAvailable(array('id','titulo'));

			$db = new ControllerJson();

			$result = $db->updateCategoriaController($_POST['id'],$_POST['titulo']);

			if($result){

				//esto significa que no hay ningun error
				$response['error'] = false;
				//mensaje que se ejecuto correctamente
				$response['message'] = 'categoria editada correctamente';

				$response['contenido'] = $db->readCategoriasController();
			}else{
				$response['error'] = true;
				$response['message'] = 'ocurrio un error, intenta nuevamente';
			}

			break;

		case 'deletecategoria':

			if(isset($_GET['id']) && !empty($_GET['id'])){

				$db = new ControllerJson();
				if($db->deleteCategoriaController($_GET['id'])){
					$response['error'] = false;
					$response['message'] = 'categoria eliminada';
					$response['contenido'] = $db->readCategoriasController();
				}else{
					$response['error'] = true;
					$response['message'] = 'la categoria no fue eliminada';
				}
			}

			break;

		//operacion Componente
		case 'leer_componente':
			$db = new ControllerJson();
			$response['error'] = false;
			$response['message'] = 'solicitud completada correctamente';
			$response['contenido'] = $db->leerComponentesController();
			break;
	}

}else{
	//si no es un api el que se esta invocando
	//empujar los valores apropiados en la estructura json
	$response['error'] = true;
	$response['message'] = 'Invalid API Call';
}

echo json_encode($response);

?>