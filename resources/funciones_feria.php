<?php
require_once("pdo.php");
require_once("./resources/funciones_usuarios.php");

function guardar_feria($db, $nombre, $ubicacion, $desde, $hasta, $descripcion, $id, $pic_name, $ext){
     $fecha_creacion = date("Y-m-d");
     $id_usuario = traerUsuarioLogueado()["us_id"];
     $query = $db->prepare("INSERT into ferias values (default, $id_usuario, :nombre, :desde, :hasta, :ubicacion, :descripcion, '$fecha_creacion', null, null)");
     $query = $db->prepare("INSERT into imagenes values (default, null, null, '$pic_name', $id_usuario)");

     $query -> bindParam(":nombre",$nombre, PDO::PARAM_STR);
     $query -> bindParam(":ubicacion",$ubicacion, PDO::PARAM_STR);
     $query -> bindParam(":desde",$desde, PDO::PARAM_STR);
     $query -> bindParam(":hasta",$hasta, PDO::PARAM_STR);
     $query -> bindParam(":descripcion", $descripcion, PDO::PARAM_STR);
     $query->execute();
}


function feria($value){

      global $db;

       $query = $db->prepare("SELECT * FROM feriate_db.ferias WHERE ferias.fe_id = $value");
       $query->execute();
       $datos_feria = $query->fetch(PDO::FETCH_ASSOC);

     return $datos_feria;
   }


  // $archivo = "./db/ferias.json";
  // //para leer y obtener el contenido del archivo
  // $json_content = file_get_contents($archivo);
  // //para convertir el contenido del archivo en un array
  // $array_content = json_decode($json_content,true);
  //
  // $datos_ferias='';
  // foreach ($array_content["ferias"] as $feria) {
  //   if ($feria["id"] == $value){
  //     $datos_ferias = $feria;
  //   }
  // }
  // return $datos_ferias;


?>
