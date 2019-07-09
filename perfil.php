<?php

require_once("./resources/funciones_usuarios.php");

$usuarioLogueado = traerUsuarioLogueado();
?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald|Pathway+Gothic+One|Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cookie|Inconsolata&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abel|Abril+Fatface|Alegreya|Arima+Madurai|Dancing+Script|Dosis|Merriweather|Oleo+Script|Overlock|PT+Serif|Pacifico|Playball|Playfair+Display|Share|Unica+One|Vibur">
    <script src="https://kit.fontawesome.com/14dd9125ec.js"></script>
    <link rel="stylesheet" href="css/perfil.css">
    <title>Perfil</title>
  </head>
  <body>
  <header>
    <?php include("header.php") ?>
  </header>
  <main>
    <div class="info">
          <div class="img">
            <?php if ($usuarioLogueado != null) : ?>
            <img src="img_user/<?=$usuarioLogueado["avatar"]?>" alt="" class="img-thumbnail">
            <?php endif; ?>
            <?php if ($usuarioLogueado["avatar"] == null) : ?>
            <img src=".\img_user\usuaria.jpg" alt="" class="img-thumbnail">
            <?php endif; ?>
   </div>
    <div class="datos">
        <h1><?php if ($usuarioLogueado != null) : ?>
          <h2 class="title">Bienvenida <?=$usuarioLogueado["nombre"]?></h2>
            <?php else: ?>
            <?php header("location: login.php") ?>
            <?php endif; ?></h1>
            <?php if ($usuarioLogueado != null) : ?>
              <h4><?=$usuarioLogueado["email"]?></h4>
            <?php endif; ?>
            <h6>Registrada desde 1/04/2018</h6>
        <button type="button" name="button">Editar informacion<i class="fas fa-user-edit"></i></button>
     </div>
    </div>
   <div class="secciones">
     <div class="comprar">
        <h1>Gestiona tus ferias..</h1>
        <a href="mis_ferias.php?id=<?php echo traerUsuarioLogueado()["id"] ?>"><button type="button" name="button">Editar ferias <i class="fas fa-store"></i></button></a>
        <a href="crear_feria.php">  <button type="button" name="button">Crea una feria! <i class="fas fa-store"></i></button></a>
     </div>
     <div class="comprar">
        <h1>.. o tus compras</h1>
        <a href="carrito.php?id=<?php ?>"><button type="button" name="button">Mi carrito<i class="fas fa-shopping-cart"></i></button></a>
        <a href="carrito.php?id=<?php ?>"><button type="button" name="button">Ver mis medios de pago<i class="fas fa-shopping-cart"></i></button></a>
     </div>
    </div>
  </main>
  <footer>
  <?php include("footer.php") ?>
  </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
