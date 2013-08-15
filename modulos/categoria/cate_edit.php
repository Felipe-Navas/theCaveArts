<?php
include('../templates/header.php');


$obj= new Seleccionar;

$id=$_GET['id']; 

$query= $obj->get_one('categoria','cate_id',$id);

if(isset($_SESSION['usuario_id']))
{
  $usuario_tipo=$_SESSION['usuario_tipo'];
  if($usuario_tipo==1){
    ?>


    <h2>Actualización de Categoria</h2>

    <?php
    $resultado=mysql_fetch_assoc($query);

    ?>
    <p class="pagetittle">Modificar Datos</p>
    <form id="contact_form" class="contact_form" action="../../lib/update.php" method="post" name="contact_form">
      <ul>
        <li>
          <label>Nombre:</label>
          <input type="text" name="array[]" required class="required" value="<?php echo $resultado['cate_nom'] ?>" >
          <input type="hidden" name="id" value="<?php echo $resultado['cate_id'] ?>"/>
        </li>             
        <li>
          <label>Descripcion:</label>
          <textarea required class="required" name="array[]"><?php echo $resultado['cate_desc'] ?></textarea>
        </li>
      </li>
      <input type="hidden" name="tabla" value="categoria">

      <li>
        <li>
          <button type="submit" id="submit" name="submit" class="button fright">Actualizar</button>
        </li>
      </ul>
    </form>

    <?php 

  } 
  if($usuario_tipo==2){
    echo "<p>Como usted es un usuario comun no puede agregar una nueva categoria.<p/>";
    echo "<p>Solo tiene permisos el administrador.<p/>";
  }

}else{
  echo "<p>Hay que logearse(arriba a la derecha del menu). para agregar una nueva categoria.</p>";
}
include('../templates/footer.php')?>
