<?php
#servidor
$host='localhost';
#nombre base de datos
$bd='Hospital';
#usuario
$user='postgres';
#password
$pass='basedatos';

$conexion=pg_connect("host=$host dbname=$bd user=$user password=$pass");
?>
