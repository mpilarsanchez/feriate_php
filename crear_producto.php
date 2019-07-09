<?php include("./resources/funciones_productos.php");

$nombre="";
$precio="";
$descripcion="";

$errores =[];

if ($_POST) {

// Leer los datos del formulario
  $id = parse_url($_SERVER['HTTP_REFERER']);
  parse_str($id["query"],$query);
  $id_feria = $query['feria'];
  $nombre = $_POST["nombre"];
  $precio = $_POST["precio"];
  $cantidad = $_POST["cantidad"];
  $descripcion = $_POST["descripcion"];
  $categoria = $_POST["categoria"];
  $talle = $_POST["talle"];
  $marca = $_POST["marca"];
  $estado = $_POST["estado"];
  $foto_producto = $_FILES["foto_producto"];
  $archivo = $_FILES["foto_producto"]["tmp_name"];
  $pic_name = $_FILES["foto_producto"]["name"];
  $ext = pathinfo($_FILES["foto_producto"]["name"],PATHINFO_EXTENSION);
  $size = $_FILES["foto_producto"]["size"]/1000;
  $id = rand(1, 9999999);

  if(strlen($nombre) < 4) {
    $errores []= "El nombre debe teber al menos 5 caracteres";
  }
  if(strlen($precio) == null) {
    $errores []= "debes poner precio a tu producto";
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

    guardarProductos($nombre, $precio, $cantidad, $descripcion, $categoria, $talle, $marca, $estado, $pic_name, $ext, $id_feria);
    header("location: feria.php?id=$id_feria");


  }
}

 ?>


<html lang="en" dir="ltr">
<head>
  <?php
  include("head.php");
   ?>
   <link rel="stylesheet" href="./css/crear_producto.css">
</head>
<header>
  <?php
  include("header.php");
   ?>
</header>

<body>
<h1>Vende tu producto!</h1>
<main>
  <h1>Descripcion y precio</h1>
  <form method="post" action="crear_producto.php" enctype="multipart/form-data">
      <div class="descripcion">
        <div class="item_desc">
          <label for="nombre">Titulo<span>*</span></label>
          <br>
          <input type="nombre"  id="nombre" placeholder="Nombre de tu producto" name="nombre" required>
          <br>
        </div>
        <div class="item_desc">
          <label for="descripcion">Descripcion</label>
          <br>
          <textarea name="descripcion" id="descripcion" placeholder="descripcion"></textarea>
          <br>
        </div>
        <div class="item_desc">
          <label for="precio">Precio<span>*</span></label>
          <br>
          <input type="number" name="precio" value="precio" required>
        </div>
        <div class="item_desc">
          <label for="cantidad">Cantidad<span>*</span></label>
          <br>
          <input type="number" name="cantidad" value="cantidad" required>
        </div>
      </div>
    <h1>Subi fotos!</h1>
  <div class="upload_img">
      <div class="foto">
          <h3>Imagen Principal</h3>
        <div class="display">
        </div>
    <div class="boton">
      <input type="file" id="upload" name="foto_producto" value="foto_producto">
    </div>
      </div>
      <div class="foto">
    <h3>Otras imagenes</h3>
    <div class="display">
    </div>
  <div class="boton">
  <input type="file" id="upload" name="" value="">
  </div>
  </div>
  <div class="foto">
    <h3>Otras imagenes</h3>
<div class="display">
</div>
<div class="boton">
<input type="file" id="upload" name="" value="">
</div>
</div>
  </div>
  <br>
  <div class="inicio">
    <div class="item">
      <label for=""> Categoria<span>*</span></label>
      <select name="categoria" required>
            <option>Ropa</option>
            <option>Muebles</option>
            <option>Juguetes</option>
            <option>Electro</option>
            <option>Shoes</option>
          </select>
          <br>
      <label for=""> Talle<span>*</span></label>
      <select name="talle">
            <option>xs</option>
            <option>s</option>
            <option>m</option>
            <option>l</option>
            <option>xl</option>
          </select>
          <br>
    </div>
    <div class="item">
      <label for=""> Marca <span>*</span></label>
      <input type="text" name="marca" value="">
      <br>
        <label for=""> Estado<span>*</span></label>
        <select name="estado">
              <option>malo</option>
              <option>regular</option>
              <option>bueno</option>
              <option>nuevo</option>
            </select>
      </div>
      </div>
      <button type="submit" id="crear" class="btn btn-primary">Ferialo!</button>
    </form>
    <ul>
      <?php foreach ($errores as $error) :?>
        <li style="color:red"><?=$error?></a></li>
      <?php endforeach; ?>
    </ul>
</main>
<footer>
<?php include("footer.php") ?>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
