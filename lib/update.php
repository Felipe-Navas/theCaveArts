<?php
include('connect.php');
//mysql_insert_id() para saber el ultimo id insertado(no probado)

$cont=0;

$id=$_POST["id"];


$tabla=$_POST["tabla"];

$datos_traidos=$_POST["array"];

$cadena_datos="";

foreach ($datos_traidos as $value){
	$cadena_datos.="'".$value."',";
};

$array_datos = explode(",", $cadena_datos);

$cadena_columna="";

$tabla_col="'".$tabla."'";

$query=mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = $tabla_col and table_schema = 'efi_php'")or die(mysql_error());

$fila=mysql_fetch_array($query);

$aux=$fila[0];

unset($fila[0]);

while($fila=mysql_fetch_assoc($query)){
	foreach ($fila as $value) {
		$cadena_columna.="`".$value."` = ".$array_datos[$cont].",";
		$cont++;
	}
};
$cadena_columna = trim($cadena_columna, ',');

$query="UPDATE `efi_php`.".$tabla." SET ".$cadena_columna."  WHERE `".$tabla."`.`".$aux."` = $id";

$result1 = mysql_query($query) or die(mysql_error());

header("Location: " . $_SERVER['HTTP_REFERER']);
?>