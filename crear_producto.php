<?php include("./resources/_funciones_productos.php");

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
  $id_categoria = $_POST["categoria"];
  $talle = $_POST["talle"];
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

    guardarProductos($nombre, $precio, $cantidad, $descripcion, $id_categoria, $talle, $estado, $pic_name, $ext, $id_feria);
    header("location: feria.php?id=$id_feria");


  }
}

 ?>


<html lang="en" dir="ltr">
<head>
  <?php
  include("head.php");
   ?>
   <link rel="stylesheet" href="./css/main.css">
   <link rel="stylesheet" href="./css/crear_producto.css">
</head>
<header>
  <?php
  include("header.php");
   ?>
</header>

<body>
  <div class="container">
<h1>Vende tu producto!</h1>
<main>
  <form method="post" action="crear_producto.php" enctype="multipart/form-data">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="nombre"> Titulo <span>*</span></label>
        <input type="nombre" class="form-control" id="nombre" placeholder="nombre de tu producto" name="nombre">
      </div>
      <div class="form-group col-md-6">
        <label for="precio"> Precio <span>*</span></label>
        <input type="number" class="form-control" id="precio" placeholder="precio" name="precio">
      </div>
      <div class="form-group col-md-6">
        <label for="cantidad"> Cantidad <span>*</span></label>
        <input type="text" name="cantidad" class="form-control" id="cantidad" placeholder="Cantidad" required>
      </div>
      <div class="form-group col-md-6">
        <label for="pass">Descripcion<span>*</span></label>
        <textarea type="text" class="form-control" id="descripcion" placeholder="Descripcion" name="descripcion" required ></textarea>
      </div>
      <div class="form-group col-md-4">
        <div class="input-group-prepend">
        <label class="input-group-text" for="inputGroupSelect01">Categoria<span>*</span></label>
          </div>
            <select class="custom-select" id="inputGroupSelect01" name="categoria">
              <?php foreach (traerCategorias() as $categoria)  :?>
                <option value="<?php echo $categoria["cat_id"] ?>"><?php echo $categoria["cat_nombre"] ?></option>
              <?php endforeach;?>
       </select>
      </div>
        <div class="form-group col-md-4">
          <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Talle<span>*</span></label>
          </div>
          <select class="custom-select" id="inputGroupSelect01" name="talle">
            <option selected>xs</option>
            <option value="1">s</option>
            <option value="2">m</option>
            <option value="3">l</option>
            <option value="4">xl</option>
          </select>
        </div>
        <div class="form-group col-md-4">
            <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Estado <span>*</span></label>
          </div>
          <select class="custom-select" id="inputGroupSelect01" name="estado">
            <option selected>elige</option>
            <option value="1">bueno</option>
            <option value="2">malo</option>
            <option value="3">nuevo</option>
          </select>
              </div>
       </div>
       <h1>Subi fotos!</h1>
       <div class="upload_img">
        <div class="imagen">
          <h3>Imagen Principal</h3>
          <div class="display">
        </div>
        <input type="file" class="form-control-file" name="foto_producto" value="foto_producto">
        </div>
        <div class="imagen">
        <h3>Otras imagenes</h3>
          <div class="display">
          </div>
          <input type="file" class="form-control-file" name="" value="">
        </div>
      <div class="imagen">
        <h3>Otras imagenes</h3>
        <div class="display" class="mt-5">
        </div>
        <input type="file" class="form-control-file" name="" value="">
      </div>
    </div>
     <button type="submit" class="btn btn-outline-light btn btn-lg btn-block mt-3" id="boton">Ferialo!</button>
    </form>
    <ul>
      <?php foreach ($errores as $error) :?>
        <li class="alert alert-danger" role="alert"><?=$error?></a></li>
      <?php endforeach; ?>
    </ul>
</main>
</div>
<footer>
<?php include("footer.php") ?>
</footer>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
