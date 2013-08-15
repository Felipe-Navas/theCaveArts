<?php
include("../../../lib/clases/class.mysql.php");
include("../../../lib/clases/class.combos.php");
$selects = new selects();
$comunidades = $selects->cargarComunidades();
foreach($comunidades as $key=>$value)
{
  echo "<option value=\"$key\">$value</option>";
}
?>