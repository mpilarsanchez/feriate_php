<?php
require_once("pdo.php");
require_once("funciones_usuarios.php");

function productos($value){
  $archivo = "./db/productos.json";
  //para leer y obtener el contenido del archivo
  $json_content = file_get_contents($archivo);
  //para convertir el contenido del archivo en un array
  $array_content = json_decode($json_content,true);

  $datos_productos=[];
  foreach ($array_content["productos"] as $producto) {
    if ($producto["categoria"] == $value){
        $datos_productos[] = $producto;
    }
  }
  return $datos_productos;
}

function productos_feria($value){
  $archivo = "./db/productos.json";
  //para leer y obtener el contenido del archivo
  $json_content = file_get_contents($archivo);
  //para convertir el contenido del archivo en un array
  $array_content = json_decode($json_content,true);

  $datos_productos=[];
  foreach ($array_content["productos"] as $producto) {
    if ($producto["fe_id"] == $value){
        $datos_productos[] = $producto;
    }
  }
  return $datos_productos;
}

function guardarProductos($nombre, $precio, $cantidad, $descripcion, $id_categoria, $talle, $estado, $pic_name, $ext, $id_feria){

global $db;
  $fecha_creacion = date("Y-m-d");
  $id_usuario = traerUsuarioLogueado()["us_id"];
  //var_dump('default', $nombre, $precio, $cantidad, $descripcion, 'null', 0, $id_feria, $id_categoria, $id_usuario ); exit;
  $query = $db->prepare("INSERT into productos values (default, :nombre, :precio, :cantidad, :descripcion, null, 0,$id_feria, $id_categoria, $id_usuario)");
  $query -> bindParam(":nombre",$nombre, PDO::PARAM_STR);
  $query -> bindParam(":precio",$precio, PDO::PARAM_INT);
  $query -> bindParam(":cantidad",$cantidad, PDO::PARAM_INT);
  $query -> bindParam(":descripcion",$descripcion, PDO::PARAM_STR);
  $query->execute();
    $query = $db->prepare("INSERT into imagenes values (default, null, null, '$pic_name', $id_usuario)");
    $query->execute();
}

function traerCategorias(){
  global $db;

   $query = $db->prepare("SELECT * FROM feriate_db.categorias");
   $query->execute();
   $categorias = $query->fetchAll(PDO::FETCH_ASSOC);
  return $categorias;
}


 ?>
