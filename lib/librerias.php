<?php
/* Argumentos de la funcion:
 * $tabla = nombre de la tabla de la cual seleccionar todo
 * $campo_value = valor que va a enviar el combo 
 * $campo_texto = El campo que se va a mostrar en el texto del combo
 * $name = name del select el sirve para recuperar el valor del combo en archivo que lo procesa
 */
function crearCombo($tabla,$campo_value,$campo_texto,$name){
	$resultado=mysql_query("select * FROM $tabla") or die (mysql_error());
	$combo="<select name='$name'>";
// mysql_fetch_assoc($resultado) esta funcion asocia los nombres de los campos a la variable $fila
// para poder imprimirlos
	while($fila = mysql_fetch_assoc($resultado)){
        // .= lo que permite es concatenar el siguiente valor a lo que ya contenga $combo
		$combo.= "<option value = '$fila[$campo_value]'> $fila[$campo_texto] </option>";
	}
	$combo.="</select>";	

//El retorno de la funcion devuelve la variable $combo con el el string html del combo
	return $combo;
}

?>


<SCRIPT LANGUAGE="JavaScript">
function validar_password() {
	var invalid = " "; 
	var minLength = 6;
	var pw1 = document.form_pass.password1.value;
	var pw2 = document.form_pass.password2.value;
// validacion si estan vacias
if (pw1 == '' || pw2 == '') {
	alert('Por favor ingresa tu password.');
	return false;
}
// validar el lenght de la password
if (document.form_pass.password1.value.length < minLength) {
	alert('Tu contraseña debe ser de al menos ' + minLength + ' caracteres de longitud. Intentalo nuevamente.');
	return false;
}
// validacion para que no tenga espacios
if (document.form_pass.password1.value.indexOf(invalid) > -1) {
	alert("Perdon los espacios no estan permitidos.");
	return false;
}
else {
	if (pw1 != pw2) {
		alert ("No has ingresado tu contraseña dos veces. Por favor ingresa tu contraseña nuevamente.");
		return false;
	}
	else {
		document.form_pass.password.value=pw1;
		return true;
	}
}
}
</script>


<?php

class comentario
{
	private $come_id;
	private $come_cont;
	private $come_fech;
	private $obra_id;
	private $usua_id;	

	function __construct($c_id,$c_co,$c_fe,$o_id,$u_id)
	{
		$this->come_id=$c_id;
		$this->come_cont=$c_co;
		$this->come_fech=$c_fe;
		$this->obra_id=$o_id;
		$this->usua_id=$u_id;
	}

	public function insertar(){

		$insertar=mysql_query("INSERT INTO `php_efi`.`comentarios` (
			`come_id` ,
			`come_cont` ,
			`come_fech` ,
			`obra_id` ,
			`usua_id`
		)
		VALUES (NULL , '$this->come_id', '$this->come_cont', '$this->come_fech', '$this->obra_id', '$this->usua_id');");


		$cadena = $_POST['tags'];
//guardo en $tags un array que separa una cadena en las cosmas "," con la funcion explode
		$tags = explode(",", $cadena);
//recorro el array trayendo en valor de cada subindice en $valor para ir comparando
		foreach ($tags as $valor) {
//selecciono el id del tag para ver si lo tengo en la DB
			$tag_id=mysql_query("SELECT tag_id from tags where tag_desc = '$valor'");

			$post_id= mysql_fetch_assoc(mysql_query("SELECT pos_id
				FROM post
				ORDER BY `post`.`pos_id` DESC
				LIMIT 1"));

			if($tag_id){
				$insertar_hija=mysql_query("INSERT INTO tags_post_id (tags_id , post_id , tp_id) VALUES ('$tag_id' , '$post_id , NULL );");	
			}else
			{
				$insertar_tags=mysql_query("insertar el nuevo tag con $valor");
				$seleccionar_ultim_id_tag=mysql_query("seleccionar el ultimo id insertado en tags");
				$insertar_hija=mysql_query("insertar en la tabala hija con el $tag_id");
			}}


		}
	}

	?>

	
<?php 

class Seleccionar{

    function get_all($table){
          $query = mysql_query("SELECT * FROM $table") or die ('Mysql Error: '. mysql_error());
          return $query;   
    }

    function get_one($table,$field_id,$id){
          $query = mysql_query("SELECT * FROM $table WHERE $field_id=$id") or die ('Mysql Error: '. mysql_error());
          return $query;   
    }

}   
?>