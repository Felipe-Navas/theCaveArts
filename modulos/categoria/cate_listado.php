<?php 
include('../templates/header.php');
$obj= new Seleccionar;
$query= $obj->get_all('categoria');




if(isset($_SESSION['usuario_id']))
{
    $usuario_tipo=$_SESSION['usuario_tipo'];
    if($usuario_tipo==1){
        ?>
        <p class="pagetittle">Listado De Categorias</p>

        <table id="tfhover" class="tftable" border="1">
            <thead>
                <tr>
                    <th>Nombre</th>            

                    <th>Descripcion</th> <th>Acciones</th>
                </tr>
            </thead>
            <?php
            while($fila = mysql_fetch_assoc($query)) {  
              ?>

              <tr>
                <td><?php echo $fila['cate_nom']; ?></td>
                <td><?php  echo $fila['cate_desc']; ?></td>

                <td> <a href="<?php echo "http://". $_SERVER['SERVER_NAME'].'/modulos/categoria/cate_edit.php?id='. $fila['cate_id']?>">Editar</a></td>
            </tr>

            <?php } ?>  

        </table>

        <a class="button fright" href="<?php echo "http://". $_SERVER['SERVER_NAME'].'/modulos/categoria/cate_new.php'?>">Nueva Categoria</a>

        <?php 
    } 
    if($usuario_tipo==2){
        echo "<p>Como usted es un usuario comun no puede agregar una nueva categoria.<p/>";
        echo "<p>Solo tiene permisos el administrador.<p/>";
    }

}else{
    echo "<p>Hay que logearse(arriba a la derecha del menu). para agregar una nueva categoria.</p>";
}

include('../templates/footer.php'); ?>