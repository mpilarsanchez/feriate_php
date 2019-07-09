<?php
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

function guardarProductos($nombre, $precio, $cantidad, $descripcion, $categoria, $talle, $marca, $estado, $pic_name, $ext, $id_feria){
  $archivo = "./db/productos.json";
  $producto = [
      "nombre" => $nombre,
      "precio" => $precio,
      "cantidad"=> $cantidad,
      "descripcion" => $descripcion,
      "categoria" =>$categoria,
      "talle" => $talle,
      "marca" => $marca,
      "estado" => $estado,
      "foto_producto" => $pic_name,
      "id_usuario" => traerUsuarioLogueado()["id"],
      "fe_id" => $id_feria,

    ];

  //para leer y obtener el contenido del archivo
  $json_content = file_get_contents($archivo);
  //para convertir el contenido del archivo en un array
  $array_content = json_decode($json_content,true);
  //para pechar al array el nuevo usuario
  array_push($array_content["productos"], $producto);
  // para convertir el array a json
  $productos_json = json_encode($array_content);
  //p guardar/ESCRIBIR productos en el archivo "productos.json"
  file_put_contents($archivo, $productos_json);

}

 ?>
