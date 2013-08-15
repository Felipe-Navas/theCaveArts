<?php
include("../../../lib/clases/class.mysql.php");
include("../../../lib/clases/class.combos.php");
$localidades = new selects();
$localidades->code = $_GET["code"];
$localidades = $localidades->cargarLocalidades();
foreach($localidades as $key=>$value)
{
		echo "<option value=\"$key\">$value</option>";
}
?>