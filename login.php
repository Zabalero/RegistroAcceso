<?php
//Se inicia la sesión
session_start();


//Se establecen las variables de sesión
$_SESSION['usuario']=$_POST['usuario'];
$_SESSION['password']=$_POST['password'];

//Se incluyen las funciones necesarias
include ('funciones.php');

if (es_usuario($_SESSION['usuario'],$_SESSION['password'])){
//Si el usuario es un usuario registrado
header("Location: gestion.php");

}
else{
header("Location: index.php");

}



?>

