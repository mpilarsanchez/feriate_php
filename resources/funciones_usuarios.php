<?php
session_start();
require_once("pdo.php");
require_once("./mail.php");


//REFACTORIZACION CODIGO - PARA TRABAJAR CON LA BASE DE DATOS
//archivo modificado: funciones_usuarios.php
 function validarRegistracion($datos){

   // Leer los datos del formulario
     $nombre = $datos["nombre"];
     $apellido = $datos["apellido"];
     $email = $datos["email"];
     $pass = $datos["pass"];
     $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
     $pass_confirm = $datos["pass_confirm"];
     $pass_verify = password_verify($pass, $pass_hash);
     $notificaciones = 0;
     if (isset($datos["notificaciones"])){
     $notificaciones = 1;
     }

   if(strlen($nombre) < 5) {
     $errores []= "El nombre debe teber al menos 4 caracteres";
   }
   if(strlen($apellido) < 5) {
     $errores []= "El apellido debe teber al menos 4 caracteres";
   }
   if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
       $errores[] ="El mail no tiene el formato correcto <br>";
     }
     if (strlen($pass) < 8) {
       $errores[] ="La contraseña debe tener al menos 8 digitos";
     }
     if (!preg_match('`[a-z]`', $pass)){
       $errores[] = "La clave debe tener al menos una letra";
     }
     if (!preg_match('`[0-9]`',$pass)){
       $errores[] = "La clave debe tener al menos un caracter numérico";
     }
     if ($pass !== $pass_confirm) {
       $errores[] = "Las contranseñas no verifican";
     }
     if(existeElEmail($email)){
       $errores[]= "Este email ya existe";
     }

     if (isset($_POST["aceptar_terminos"]) == null) {
       $errores[]="Debe aceptar los términos y condiciones";
     }

   if(empty($errores)){
     save_registered_user(abrirBaseDeDatos(), $nombre, $apellido, $email, $pass_hash, $notificaciones);
     header("location: home.php");

   }else{
     return $errores;
   }
  }
  function save_registered_user($db, $nombre, $apellido, $email, $pass_hash, $notificaciones){
     $fecha_registracion = date("Y-m-d");
     $query = $db->prepare("INSERT into usuarios values (default, :nombre, :apellido, :email, :pass_hash, null, null, null, null, '$fecha_registracion', null, 1, $notificaciones)");
        $query -> bindParam(":nombre",$nombre, PDO::PARAM_STR);
        $query -> bindParam(":apellido",$apellido, PDO::PARAM_STR);
        $query -> bindParam(":email",$email, PDO::PARAM_STR);
        $query -> bindParam(":pass_hash",$pass_hash, PDO::PARAM_STR);
        $query->execute();

   //Enviar mail a nuevo usuario
        $template = 'usuario_nuevo.html';
        $subject = 'Bienvenido '.$nombre;
        enviar_mail($nombre, $email, $template, $subject);
   }

//   function traerTodosLosUsuarios() {
//     global $db;
//
//      $query = $db->prepare("SELECT * FROM feriate_db.usuarios");
//      $query->execute();
//      $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
//
//    return $usuarios;
//
// }


  function validarLogin($datos) {
    $errores = [];

    if (!existeElEmail($datos["email"])) {
      $errores["email"] = "Los datos son incorrectos";
    }
    else {
      $usuario = traerUsuarioPorEmail($datos["email"]);

      if (password_verify($datos["pass"], $usuario["us_pass"]) == false) {
        $errores["email"] = "Los datos son incorrectos, por contrasenia";
      }else{
        //redirigir
      }
    }

    return $errores;
  }

  function existeElEmail($email) {
    $usuario = traerUsuarioPorEmail($email);

    if ($usuario == null) {
      return false;
    } else {
      return true;
    }
  }

  function traerUsuarioPorEmail($email) {
  //  $usuarios = traerTodosLosUsuarios();
    global $db;
    $query = $db->prepare("SELECT * FROM usuarios WHERE us_email = :email");
    $query ->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $usuario = $query->fetch(PDO::FETCH_ASSOC);

if($usuario) return $usuario;
return null;

}
  function loguear($email) {
    $_SESSION["usuarioLogueado"] = $email;
  }

  function estaLogueado() {
    if (isset($_SESSION["usuarioLogueado"])) {
      return true;
    }
    else {
      return false;
    }
  }

  function traerUsuarioLogueado() {
    if (estaLogueado()) {
      return traerUsuarioPorEmail($_SESSION["usuarioLogueado"]);
    }

    return null;
  }

  function esDuenodeFeria($id_feria){
      if (feria($id_feria)["fe_us_id"] == traerUsuarioLogueado()["us_id"]){
        return true;
      }
  }

?>
