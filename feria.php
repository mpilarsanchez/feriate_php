<?php

if ($_GET){
  $value = $_GET["id"];

 require_once("./resources/funciones_feria.php");

  $datos_ferias =feria($value);

  require_once("./resources/_funciones_productos.php");

    $datos_productos =productos_feria($value);

    require_once("./resources/funciones_usuarios.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <?php
  include("head.php");
   ?>
   <link rel="stylesheet" href="./css/main.css">
   <link rel="stylesheet" href="./css/feria.css">
</head>
<body>
<header>
<?php include("header.php") ?>
       </header>
       <div class="container">
  <div class="inicio">
    <div class="imagen">
      <img src="images/inicio.jpg" alt="">
    </div>
    <div class="info">
      <h1><?php echo $datos_ferias["fe_nombre"] ?></h1>
          <h4 ><a href="#">Ver perfil de Ana</a></h4>
          <h2> <i class="fas fa-star-of-life"></i><?php echo $datos_ferias["fe_ubicacion"] ?></h2><h4><a target="_blank" href="https://www.google.com/maps/place/<?php echo $datos_ferias['fe_ubicacion'] ?>" title="Click para ver en el mapa">Ver ubicacion</a> </h4>
          <h2> <i class="fas fa-star-of-life"></i>Fecha:<?php echo $datos_ferias["fe_desde"] ?></h2>
          <h2> <i class="fas fa-star-of-life"></i>Fecha:<?php echo $datos_ferias["fe_hasta"] ?></h2>
        <?php if(estaLogueado()):?>
         <?php if(esDuenoDeFeria($value)):?>
           <a href="crear_producto.php?feria=<?php echo $datos_ferias["fe_id"] ?>"><button id="boton" type="button" name="button">Cargar Productos</button></a>
           <a href="#"><button id="boton" type="button" name="button" disable>Editar Feria</button></a>
         <?php endif ?>
      <?php endif ?>
    </div>
  </div>
  <?php if(!empty($datos_productos)) :?>
  <div class="botones">
    <div class="dropdown">
      <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        ORDENAR POR
      </a>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
      </div>
    </div>
    <div class="dropdown">
      <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        FILTRAR POR
      </a>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <a class="dropdown-item" href="#">Something else here</a>
      </div>
    </div>
  </div>
<?php endif ;?>
  <hr>
    <?php if(empty($datos_productos)) :?>
     <div class="alert alert-danger" role="alert">
    <p>Lo Sentimos No Hay Productos para la Categoria seleccionada</p>
    </div>
  <?php endif ;?>
  <main>
    <div class="producto">
  <?php if(!empty($datos_productos)) :?>
      <?php foreach ($datos_productos as $producto) :?>
          <div class="card" >
          <img src="img_user/<?php echo $producto['foto_producto'] ?>" class="card-img-top" alt="...">
          <div class="card-body">
            <h4 class="card-text"><?php echo $producto['nombre'] ?></h4>
            <div class="descripcion">
             <h3 class="precio"><b>Precio:<?php echo $producto['precio'] ?></b><h3>
             <h3 class="talle"><b>Talle:<?php echo $producto['talle'] ?></b></h3>
             <h3 class="marca"><b>Marca:<?php echo $producto['marca'] ?></b></h3>
           </div>
           <div class="descripcion">
             <h3 class="estado"><b>Estado:<?php echo $producto['estado'] ?></b></h3>
             <h3 class="cantidad"><b>Cantidad:<?php echo $producto['cantidad'] ?></b></h3>
            </div>
        </div>
            <div class="comprar">
            <?php if(estaLogueado() && !esDuenoDeFeria($value) ):?>
              <a href="carrito.php"><button type="button" name="button" class="btn btn-light m-2"><i class="fas fa-shopping-cart"></i>  Agregar al carrito!</button></a>
              <button type="button" name="button" class="btn btn-light m-2"><i class="fas fa-tag"></i>  Reserva este articulo!</button>
            <?php endif ?>
            <?php if(!estaLogueado()):?>
                 <a href="login.php" ><button type="button" name="button" class="btn btn-light m-2"><i class="fas fa-tag"></i>  logueate para comprar</button></a>
           <?php endif ?>
           <?php if(estaLogueado()):?>
            <?php if(esDuenoDeFeria($value)):?>
              <a href="#"><button id="boton"  type="button" name="button" class="btn btn-light m-2"><i class="fas fa-tag"></i>  Editar Producto</button></a>
            <?php endif ?>
         <?php endif ?>

            </div>
          </div>
        <?php endforeach ?>
        <?php endif; ?>
 </div>
</div>
<footer>
<?php include("footer.php") ?>
</footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
