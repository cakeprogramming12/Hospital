<?php

require 'conexion.php';

session_start();

/*
Declaramos las variables para almacenar el valor de los imputs
*/
$usuario=$_POST['user'];
$clave=$_POST['pass'];

$query=("SELECT * FROM usuarios 
	WHERE usuario='$usuario' AND contrasena='$clave'");

$consulta=pg_query($conexion,$query);
$cantidad=pg_num_rows($consulta);

if($cantidad>0){

	$_SESSION['nombre_usuario']=$usuario;
	header('Location:ingreso.php');
}
else{
	echo "Datos incorrectos.";
}




?>