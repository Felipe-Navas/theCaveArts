<?php session_start();?>
<?php 
include("../../lib/connect.php");




$comentario=$_POST['comentario'];
$fecha=date('Y/m/d H:i:s');
$usuario_id=$_SESSION['usuario_id'];
$obra_id=$_POST['obra_id'];
$usuario_nombre=$_SESSION['usuario_user'];



$insertar=mysql_query("INSERT INTO `efi_php`.`comentarios` (
`come_id` ,
`come_cont` ,
`come_fech` ,
`obra_id` ,
`usua_id`
)
VALUES (
NULL , '$comentario', '$fecha', '$obra_id', '$usuario_id'
);")or die(mysql_error());

if($insertar){
echo json_encode(array('control'=>1,'comentario'=>$comentario,'fecha'=>$fecha,'usuario_nombre'=>$usuario_nombre));	
}else{
echo json_encode(array('control'=>0));
}


?>