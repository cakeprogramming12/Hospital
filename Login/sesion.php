<?php

#usamos la conexion
require '../conexionphp/conexion.php';

#por si se ocupa
session_start();

/*
Declaramos las variables para almacenar el valor de los inputs
*/
$usuario=$_POST['user'];
$clave=$_POST['pass'];


#hacemos la consulta a la tabla que contenga los usuarios
$query=("SELECT * FROM hospital.usuarios 
	WHERE usuario='$usuario' AND contrasena='$clave'");


#Ejecutamos la consulta, pasando la conexion y el query
$consulta=pg_query($conexion,$query);
#numero de columnas que salieron de esa consulta
$cantidad=pg_num_rows($consulta);

#si salio un registro
if($cantidad>0){

    #variable de sesion, para poder usarlo en otra paguina
	$_SESSION['nombre_usuario']=$usuario;
	#nos dirige a otra paguina
    header('Location:../tablero/home.php');
}
#los datos estan mal
else{
	echo "Datos incorrectos.";
}




?>