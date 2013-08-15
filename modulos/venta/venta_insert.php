<?php session_start();?>
<?php
include('../../lib/connect.php');

$importe=$_POST['importe'];
$usuario_id=$_SESSION['usuario_id'];

$fecha=date('Y-m-d H:i:s');
$query=mysql_query("INSERT INTO `efi_php`.`venta` (
	`vent_id` ,
	`vent_impo` ,
	`vent_fech` ,
	`usua_id`
)
VALUES (
	NULL , '$importe', '$fecha', '$usuario_id');")or die(mysql_error());

$vent_id=mysql_insert_id();

foreach ($_SESSION['ventas'] as $value) 
{ 

	$obra_id=$value['obra_id']; 
	$insertar_hija=mysql_query("INSERT INTO `efi_php`.`detalle` (
		`deta_id` ,
		`obra_id` ,
		`vent_id` 
		)
	VALUES (
		NULL , '$obra_id', '$vent_id');")or die(mysql_error());
} 
unset($_SESSION['ventas']);
header("Location: " . $_SERVER['HTTP_REFERER']);
?>