<?php
require_once("./resources/funciones_usuarios.php");

if (estaLogueado()) {
  header("location:home.php");exit;
}

if ($_POST) {
  $errores = validarLogin($_POST);

  if (count($errores) == 0) {
    loguear($_POST["email"]);
    header("location:home.php");exit;
  } else {
    foreach ($errores as $error) {
       $error;
    }
  }
}

 ?>
<html lang="en" dir="ltr">
<head>
  <?php
  include("head.php");
   ?>
   <link rel="stylesheet" href="./css/main.css">
   <link rel="stylesheet" href="./css/login.css">
</head>
<header>
  <?php
    include("header.php");
     ?>
</header>
<body>
  <div class="formulario">
    <form method="post" action="login.php">
      <header class="head-form">
        <h2>Log In</h2>
        <p>Inicia sesion acá con tu email y contraseña.</p>
      </header>
      <br>
      <?php if(isset($error)) :?>
      <p style="color:red; font-size:12px;"><?=$error?></a></p>
      <?php endif; ?>
      <div class="field-set">
        <input class="form-input" id="txt-input" type="email" placeholder="Email" name="email" required>
        <br>
        <input class="form-input" type="password" placeholder="Contraseña" id="pwd" name="pass" required>
        <br>
        <button class="log-in"> Log In </button>
      </div>
      <div class="other">
        <button class="btn submits frgt-pass">Olvide Contraseña</button>
        <button class="btn submits sign-up"><a href='registro.php'>Registrarme</a>
        </button>
      </div>
  </div>
  </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
