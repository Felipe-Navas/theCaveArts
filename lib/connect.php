<?php
//mysql_connect recibe el nombre del host que almacena la base, el usuario y el password
 $conexion = mysql_connect('localhost', 'root', '') or die ('Fallo la conexion');
             
//Luego de establecer la conexion se selecciona la base de datos con la cual operar
mysql_select_db('efi_php',$conexion) or die ('Base de Datos Calidad no encontrada');

//or die imprime el string si algunos de estos comandos fallo

?>
