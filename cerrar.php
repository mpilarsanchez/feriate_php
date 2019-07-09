<?php
session_start();
if($_POST){
     session_destroy();
}
header("location:home.php")

 ?>
