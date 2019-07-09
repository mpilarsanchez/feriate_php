<?php

if ($_GET){
  $value = $_GET["categoria"];

require_once("./resources/funciones_productos.php");

  $datos_productos =productos($value);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <?php
  include("head.php");
   ?>
   <link rel="stylesheet" href="./css/feria.css">
</head>
<body>
<header>
<?php include("header.php") ?>
       </header>
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
  <hr>
  <?php if(empty($datos_productos)) :?>
     <p style="color:red">Lo Sentimos No Hay Productos para la Categoria seleccionada</p>
  <?php endif ;?>
  <main>
    <div class="producto">
  <?php if(!empty($datos_productos)) :?>
      <?php foreach ($datos_productos as $producto) :?>
          <div class="card" >
          <img src="images/shoes.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text"><?php echo $producto['nombre'] ?></p>
            <div class="descripcion">
              <h3 class="precio"><b>Precio: <?php echo $producto['precio'] ?></b></h3>
              <h3 class="talle"><b>Talle 39</b></h3>
              <h3 class="cantidad"><b>cantidad: <?php echo $producto['cantidad'] ?></b></h3>
            </div>
            <div class="comprar">
                <?php if(estaLogueado()):?>
                  <a href="carrito.php"> <button type="button" name="button"><i class="fas fa-shopping-cart">Agregar al carrito!</i></button></a>
                  <button type="button" name="button"><i class="fas fa-tag">Reserva este articulo!</i></button>
               <?php endif ?>
                 <?php if(!estaLogueado()):?>
                      <a href="login.php"><button type="button" name="button"><i class="fas fa-tag">Logueate para comprar</i></button></a>
                <?php endif ?>
              <a href="feria.php?id=<?php echo $producto['fe_id'] ?>" ><button type="button" name="button"><i class="fas fa-tag">Ir a esta feria</i></button></a>
            </div>
          </div>
        </div>
<?php endforeach ?>
</div>
<?php endif; ?>
<footer>
<?php include("footer.php") ?>
</footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
