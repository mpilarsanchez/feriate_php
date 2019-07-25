<?php
function abrirBaseDeDatos(){
   try {
     $dsn = 'mysql:dbname=feriate_db;host=localhost;port=3306';
     $username = 'root';
     $password =  '';
     $db= new PDO($dsn, $username, $password);
     $db ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     return $db;
   } catch (\Exception $e) {
      echo $e->getMessage();
   }
}

$db = abrirBaseDeDatos();
 ?>
