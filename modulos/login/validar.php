<?php session_start();?>
<?php
include('../../lib/connect.php');

$usuario=$_POST['usuario'];
$password=$_POST['password'];

$query=  "select * from usuario where usua_usua = '$usuario' and usua_pass = '$password'";    

$resultado = mysql_query($query) or die(mysql_error());

$resultado = mysql_fetch_assoc($resultado);

if(is_array($resultado)){
	$_SESSION['usuario_id']=$resultado['usua_id'];
	$_SESSION['usuario_nombre']=$resultado['usua_nomb'];
	$_SESSION['usuario_user']=$resultado['usua_usua'];
	$_SESSION['usuario_tipo']=$resultado['tipo_id'];
  echo  json_encode(array('control' => 1)); 
}else{
  echo  json_encode(array('control' => 0));    
}

?>
