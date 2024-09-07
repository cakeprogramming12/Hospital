<?php
#servidor
$host='localhost';
#nombre base de datos
$bd='hospital';
#usuario
$user='postgres';
#password
$pass='7109';

$conexion=pg_connect("host=$host dbname=$bd user=$user password=$pass");

$query=("\c hospital");

?> 