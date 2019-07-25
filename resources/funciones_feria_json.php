<?php
require_once("./resources/funciones_usuarios.php");

function guardar_feria($nombre, $ubicacion, $descripcion, $id, $pic_name, $ext){
  $archivo = "./db/ferias.json";
  $feria = [
      "nombre" => $nombre,
      "ubicacion" => $ubicacion,
      "descripcion" => $descripcion,
      "id" => $id,
      "avatar" => $pic_name,
      "id_usuario" => traerUsuarioLogueado()["id"]
    ];

  //para leer y obtener el contenido del archivo
  $json_content = file_get_contents($archivo);
  //para convertir el contenido del archivo en un array
  $array_content = json_decode($json_content,true);
  //para pechar al array el nuevo usuario
  array_push($array_content["ferias"], $feria);
  // para convertir el array a json
  $usuarios_json = json_encode($array_content);
  //p guardar/ESCRIBIR usuarios en el archivo "usuarios.json"
  file_put_contents($archivo, $usuarios_json);

}

//REFACTORIZACION CODIGO - PARA TRABAJAR CON LA BASE DE DATOS

// function save_feria($db, $nombre, $ubicacion, $descripcion){
//    $fecha_registracion = date("Y-m-d");
//    $consulta = $db->query("INSERT into ferias values (default, '$nombre', '$apellido', '$email', '$pass_hash', null, null, null, null, '$fecha_registracion', null, 1, 1)");
//  }

function feria($value){
  $archivo = "./db/ferias.json";
  //para leer y obtener el contenido del archivo
  $json_content = file_get_contents($archivo);
  //para convertir el contenido del archivo en un array
  $array_content = json_decode($json_content,true);

  $datos_ferias='';
  foreach ($array_content["ferias"] as $feria) {
    if ($feria["id"] == $value){
      $datos_ferias = $feria;
    }
  }
  return $datos_ferias;
}


?>
