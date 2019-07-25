<?php
session_start();

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

  if(empty($errores)){
    //guardar los datos en un archivo
    //mover foto

      $miarchivo = dirname(_FILE_);
      $miarchivo = $miarchivo. "/img/";
      $miarchivo = $miarchivo. $pic_name;
      move_uploaded_file( $archivo , $miarchivo);

    save_registered_user($nombre, $email, $pass_hash, $id, $pic_name, $ext);

    header("location: home.php");

  }else{
    return $errores;
  }
 }
//validacion y guardar usuario
 function save_registered_user($nombre, $email, $pass_hash, $id, $pic_name, $ext){
   $archivo = "./db/usuarios.json";
    $usuario = [
        "nombre" => $nombre,
        "email" => $email,
        "pass" => $pass_hash,
        "id" => $id,//proximoId(),
        "avatar" => $pic_name
      ];
//
// //   //para leer y obtener el contenido del archivo
    $json_content = file_get_contents($archivo);
// //   //para convertir el contenido del archivo en un array
    $array_content = json_decode($json_content,true);
//    //para pechar al array el nuevo usuario
    array_push($array_content["usuarios"], $usuario);
//    // para convertir el array a json
    $usuarios_json = json_encode($array_content);
// //   //p guardar/ESCRIBIR usuarios en el archivo "usuarios.json"
    file_put_contents($archivo, $usuarios_json);
//
 }



// function proximoId() {
//   $usuarios = traerTodosLosUsuarios();
//
//   if (count($usuarios) == 0) {
//     return 1;
//   }
//
//   $ultimoUsuario = end($usuarios);
//
//   return $ultimoUsuario["id"] + 1;
// }

function traerTodosLosUsuarios() {
  $archivo = file_get_contents("./db/usuarios.json");

  if ($archivo == "") {
    return [];
  }

  $usuarios = json_decode($archivo, true);

  return $usuarios["usuarios"];
}


function validarLogin($datos) {
  $errores = [];

  if (!existeElEmail($datos["email"])) {
    $errores["email"] = "Los datos son incorrectos";
  }
  else {
    $usuario = traerUsuarioPorEmail($datos["email"]);

    if (password_verify($datos["pass"], $usuario["pass"]) == false) {
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
  $usuarios = traerTodosLosUsuarios();

  foreach ($usuarios as $usuario) {
    if ($usuario["email"] == $email) {
      return $usuario;
    }
  }

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
    if (feria($id_feria)["usuario_id"] == traerUsuarioLogueado()["id"]){
      return true;
    }
}
