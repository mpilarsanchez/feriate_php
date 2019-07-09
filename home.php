
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <?php
  include("head_home.php");
   ?>
  <link rel="stylesheet" href="./css/style.css">
</head>
  <body>
      <header>
        <?php include("header.php") ?>
        </header>
           <div class="head">
             <div class="leyenda">
               <h2>PUBlICA TU FERIA</h2>
               <h3>y compartila con tus clientes, ellos reservan los productos y los retiran ese dia!</h3>
             </div>
                <?php if(estaLogueado()):?>
                   <a href="crear_feria.php"><button id="boton" type="button" name="button">CREA TU FERIA!!!!</button></a>
                <?php endif ?>
                <?php if(!estaLogueado()):?>
                  <a href="login.php"><button id="boton" type="button" name="button">Crea tu feria!</button></a>
                <?php endif ?>
             <div class="lista">
               <ul>
                 <li><i class="fas fa-star-of-life"></i>
                <span> Crea</span> tu feria</li>
                 <li><i class="fas fa-star-of-life"></i><span> Publica</span> lo que no usas</li>
                 <li><i class="fas fa-star-of-life"></i><span> Gestiona</span> las reservas</li>
                 <li><i class="fas fa-star-of-life"></i><span> Ahorra</span> tiempo</li>
                 <a href="preguntas.php"><button type="button" name="button">MAS INFO!</button></a>
               </ul>
             </div>
             </div>
             <hr>
      <main>
          <h1 class="titulo">CATEGORIAS</h1>
          <div class="categorias">
            <article class="cat">
            <div class="texto">
            <h2>ROPA Y ACCESORIOS</h2>
            <a href="ferias.php?categoria=ropa_accesorios"><button type="button" name="button">VER LAS FERIAS</button></a>
            <a href="productos.php?categoria=ropa_accesorios"><button type="button" name="button">VER PRODUCTOS</button></a>
            </div>
            <div class="imagen">
              <img src="images/inicio.jpg" alt="">
            </div>
            </article>
            <article class="cat">
            <div class="texto">
            <h2>MUEBLES</h2>
            <a href="ferias.php?categoria=muebles"><button type="button" name="button">VER LAS FERIAS</button></a>
          <a href="productos.php?categoria=muebles"><button type="button" name="button">VER PRODUCTOS</button></a>
            </div>
            <div class="imagen">
              <img src="images/muebles.jpg" alt="">
            </div>
            </article>
            <article class="cat">
            <div class="texto">
            <h2>ELECTRO</h2>
            <a href="ferias.php?categoria=electro"><button type="button" name="button">VER LAS FERIAS</button></a>
            <a href="productos.php?categoria=electro"><button type="button" name="button">VER PRODUCTOS</button></a>
            </div>
            <div class="imagen">
              <img src="images/electro.jpg" alt="">
            </div>
            </article>
            <article class="cat">
            <div class="texto">
            <h2>CALZADO</h2>
            <a href="ferias.php?categoria=calzado"><button type="button" name="button">VER LAS FERIAS</button></a>
            <a href="productos.php?categoria=calzado"><button type="button" name="button">VER PRODUCTOS</button></a>
            </div>
            <div class="imagen">
              <img src="images/shoes.jpg" alt="">
            </div>
            </article>
            <article class="cat">
            <div class="texto">
            <h2>JUGUETES</h2>
            <a href="ferias.php?categoria=juguetes"><button type="button" name="button">VER LAS FERIAS</button></a>
            <a href="productos.php?categoria=juguetes"><button type="button" name="button">VER PRODUCTOS</button></a>
            </div>
            <div class="imagen">
              <img src="images/juguetes.jpg" alt="">
            </div>
            </article>
    </div>
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
