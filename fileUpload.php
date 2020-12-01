<?php

// Ruta donde mover archivos subidos
$target_path = "users/images/";
 
// Array para la respuesta final json
$response = array();
 
// obteniendo direcion ip del server
$server_ip = gethostbyname(gethostname());
 
// url del archivo final que se subio
$file_upload_url = 'http://' . $server_ip . '/' . 'hardware' . '/' . $target_path;
 
 
if (isset($_FILES['image']['name'])) {
    $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    $name = $_POST["filename"];

    //$target_path = $target_path . basename($_FILES['image']['name']);

    $target_path = $target_path.$name.".".$extension;

    try {
        // Tirar excecion en caso de que el archivo no sea movido        
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_path)) {
            // poner bandera de error
            $response['error'] = true;
            $response['message'] = '¡No se pudo subir el archivo!';
        }
 
        // archivo subido con exito
        $response['message'] = '¡Archivo subido exitosamente!';
        $response['contenido'] = basename($_FILES['image']['name']);
    } catch (Exception $e) {
        // Excepcion ocurrida. poner bandera de error
        $response['error'] = true;
        $response['message'] = $e->getMessage();
    }
} else {
    // File parameter is missing
    $response['error'] = true;
    $response['message'] = 'Ningun archivo recibido! F';
}
 
// Echo respuesta json final al cliente
echo json_encode($response);
?>