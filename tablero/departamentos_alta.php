<?php

#servidor
$host='localhost';
#nombre base de datos
$bd='HospitalFinal';
#usuario
$user='postgres';
#password
$pass='basedatos';

$conexion=pg_connect("host=$host dbname=$bd user=$user password=$pass");

$query=("INSERT INTO departamentos(Nombre,Descripcion)
VALUES('$_REQUEST[nombre]','$_REQUEST[descripcion]')");

$consulta = pg_query($conexion, $query);
pg_close();

echo 'fue dado de alta';

?>