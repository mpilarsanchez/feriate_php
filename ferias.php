<?php

if ($_GET){

  $categoria = $_GET["categoria"];
  function datos_ferias($categoria){

        global $db;

         $query = $db->prepare("SELECT * FROM feriate_db.ferias
                                LEFT JOIN imagenes ON
                                img_fe_id = fe_id");
         $query->execute();
         $datos_ferias = $query->fetchAll(PDO::FETCH_ASSOC);
        return $datos_ferias;
}
}
 ?>

<html lang="en" dir="ltr">
<head>
  <?php
    include("head.php");
        ?>
<link rel="stylesheet" href="./css/main.css">
<link rel="stylesheet" href="./css/index.css">
</head>
<body>
  <header>
  <?php include("header.php") ?>
  </header>
    <div class="inicio">
      <h1>FERIAS AMERICANAS</h1>
      <h2>Elegi la feria segun su ubicacion o los productos que te gusten</h2>
    </div>
    <?php if(!empty(datos_ferias($categoria))) :?>
    <div class="botones">
      <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ORDENAR POR
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="#">Ubicacion</a>
          <a class="dropdown-item" href="#">Fecha</a>
        </div>
      </div>
      <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          FILTRAR POR
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="#">Producto</a>
        </div>
      </div>
    </div>
    <?php endif; ?>
    </div>
    <hr>
    <?php if(empty(datos_ferias($categoria))) :?>
       <div class="alert alert-danger" role="alert">
        <p>Lo Sentimos No Hay Datos para la Categoria seleccionada</p>
       </div>
    <?php endif ;?>
    <main>
    <?php if(!empty(datos_ferias($categoria))) :?>
        <?php foreach (datos_ferias($categoria) as $feria) :?>
        <div class="feria">
          <div class="header-feria">
            <h3><?php echo $feria["fe_nombre"] ?></h3>
            <h5><?php echo $feria["fe_ubicacion"] ?></h5>
            <a target="_blank" href="https://www.google.com/maps/place/<?php echo $feria['fe_ubicacion'] ?>" title="Click para ver en el mapa"><img src="images/mapa.jpeg" alt=""></a>
          <!---  <img src="./img_user/<?php // echo $feria["avatar"] ?>" alt="">  --->
          </div>
          <div class="boton-header">
            <a href="feria.php?id=<?= $feria["fe_id"]?>" ><button type="button" name="button">VER FERIA!</button></a>
          </div>
          <div class="descripcion">
            <?php echo $feria["fe_descripcion"] ?>
          </div>
          <div class="cuerpo-feria">
            <?php if(!empty($feria["img_nombre"])) :?>
              <img src="img_user/<?php echo $feria["img_nombre"] ?>" alt="">
              <img src="img_user/<?php echo $feria["img_nombre"] ?>" alt="">
             <?php endif; ?>
            <?php if(empty($feria["img_nombre"])) :?>
               <img src="images/logo_feriate_deffault.png" alt="">
               <img src="images/logo_feriate_deffault_ii.png" alt="">
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach ?>
     <?php endif; ?>
  </main>
  <footer>
  <?php include("footer.php") ?>
  </footer>

  <script src="https://unpkg.com/ionicons@4.5.5/dist/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
