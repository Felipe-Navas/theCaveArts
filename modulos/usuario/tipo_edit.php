<?php
//Al incluir el head ya estoy icluyendo la conexion y las librerias
include('../templates/header.php')
?>

<?php
$tipo_id=$_GET['tipo_id'];
$datos_tipo=mysql_query("Select* from tipo_usuario where tipo_id=$tipo_id ");
$resultado=mysql_fetch_assoc($datos_tipo);
?>

<p class="pagetittle">Modificar Datos</p>

<form action="../../lib/update.php" method="post"> 
  <ul>
    <li>
      <label>Nombre:</label>
      <input type="text" name="array[]" value="<?php echo $resultado['tipo_nomb'] ?>" required class="required" >
    </li> 
    <li>
      <label for="name">Descripcion:</label>
      <textarea rows="4" cols="50" name="array[]"><?php echo $resultado['tipo_desc'] ?></textarea>
    </li>
    <input type="hidden" name="tabla" value="tipo_usuario">
    <input type="hidden" name="id" value="<?php echo $resultado['tipo_id'] ?>"/>
    <li>
      <button type="submit" id="submit" name="submit">Modificar</button>
    </li> 
  </ul>     
</form>
<?php include('../templates/footer.php')?>
; 