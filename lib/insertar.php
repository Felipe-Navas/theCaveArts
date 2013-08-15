<?php
include('connect.php');
//mysql_insert_id() para saber el ultimo id insertado(no probado)

$tabla=$_POST["tabla"];

$datos_traidos=$_POST["array"];

$cadena_datos="NULL,";

$cadena_columna="";

foreach ($datos_traidos as  $value){
	$cadena_datos.="'".$value."',";
};

$tabla_col="'".$tabla."'";

$query=mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = $tabla_col and table_schema = 'efi_php'")or die(mysql_error());

while($fila=mysql_fetch_assoc($query)){
	foreach($fila as $valor) {
		$cadena_columna.="`".$valor."`,";
	};
};

$cadena_datos = trim($cadena_datos, ',');
$cadena_columna = trim($cadena_columna, ',');

$tabla="`".$tabla."`";

$query="INSERT INTO `efi_php`.".$tabla."(".$cadena_columna.") VALUES (".$cadena_datos.");";

$result1 = mysql_query($query) or die(mysql_error());

header("Location: " . $_SERVER['HTTP_REFERER']);
?>