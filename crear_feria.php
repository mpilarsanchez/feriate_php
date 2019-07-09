<?php
include("./resources/funciones_feria.php");

$nombre="";
$ubicacion="";
$errores =[];
if ($_POST) {

// Leer los datos del formulario
  $nombre = $_POST["nombre"];
  $ubicacion = $_POST["ubicacion"];
  $descripcion = $_POST["descripcion"];
  $avatar = $_FILES["foto_feria"];
  $archivo = $_FILES["foto_feria"]["tmp_name"];
  $pic_name = $_FILES["foto_feria"]["name"];
  $ext = pathinfo($_FILES["foto_feria"]["name"],PATHINFO_EXTENSION);
  $size = $_FILES["foto_feria"]["size"]/1000;
  $id = rand(1, 9999999);

  if(strlen($nombre) < 5) {
    $errores []= "El nombre debe teber al menos 5 caracteres";
  }
  if(strlen($ubicacion) < 5) {
    $errores []= "la ubicacion debe teber al menos 5 caracteres";
  }
  if(strlen($descripcion) < 5) {
    $errores []= "la descripcion debe teber al menos 5 caracteres";
  }
  if (!empty($pic_name)){
    if($ext != "jpg" && $ext !="jpeg" && $ext != "png"){
      $errores[] = "no es el formato adecuado";
    }
    if ($size > 500){
    $errores[] = "archivo muy pesado";
    }
  }

  if(empty($errores)){
    //guardar los datos en un archivo
    //mover foto

    $miarchivo = dirname(_FILE_);
    $miarchivo = $miarchivo. "/img_user/";
    $miarchivo = $miarchivo. $pic_name;
    move_uploaded_file( $archivo , $miarchivo);

    guardar_feria($nombre, $ubicacion, $descripcion, $id, $pic_name, $ext);
    header("location: feria.php?id=$id");


  }
}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/crear_feria.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Oswald|Pathway+Gothic+One|Source+Sans+Pro&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Cookie|Inconsolata&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abel|Abril+Fatface|Alegreya|Arima+Madurai|Dancing+Script|Dosis|Merriweather|Oleo+Script|Overlock|PT+Serif|Pacifico|Playball|Playfair+Display|Share|Unica+One|Vibur">
<script src="https://kit.fontawesome.com/14dd9125ec.js"></script>
<title>Crea tu feria</title>
</head>
<header>
  <?php
  include("header.php");
   ?>
</header>
  <body>
      <h1>Crea tu feria</h1>
    <div class="inicio">
    <form method="post" action="crear_feria.php" enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="nombre"> Nombre de la feria <span>*</span></label>
          <input type="nombre" class="form-control" id="nombre" placeholder="Nombre de tu feria" name="nombre">
        </div>
        <div class="form-group col-md-6">
          <label for="ubicacion"> Ubicacion  <span>*</span></label>
          <input type="text" class="form-control" id="ubicacion" placeholder="Ubicacion" name="ubicacion">
        </div>
        <div class="form-group col-md-6">
          <label for="descripcion"> Descripcion <span>*</span></label>
          <input type="text" name="descripcion" class="form-control" id="descripcion" placeholder="descripcion">
        </div>
        <div class="form-group col-md-6">
          <label for="categoria"> Horario <span>*</span></label>
          <input list="horario"  class="form-control" name="horario" placeholder="horario" autocomplete="off" >
        </div>
        <div class="foto">
          <div class="form-group col-md-6">
            <label for="foto_feria">Subi una Foto de tu feria:</label>
            <div class="display">
            </div>
            <input type="file" id="upload" name="foto_feria">
          </div>
          <a href="crear_producto.php" id="subir" class="btn btn-primary">Subi tus productos!</a>
        </div>
      <button type="submit"id="crear" class="btn btn-primary">Feriate!</button>
    </form>
    <ul>
      <?php foreach ($errores as $error) :?>
        <li style="color:red"><?=$error?></a></li>
      <?php endforeach; ?>
    </ul>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
