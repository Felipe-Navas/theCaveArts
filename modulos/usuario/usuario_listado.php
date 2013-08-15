 <?php 
 include('../templates/header.php');

 if(isset($_SESSION['usuario_id']))
 {
    $usuario_tipo=$_SESSION['usuario_tipo'];
    if($usuario_tipo==1){
     $obj= new Seleccionar;
     $query= $obj->get_all('usuario');
     ?> 
     <p class="pagetittle">Listado de Usuarios</p>
     <table id="tfhover" class="tftable" border="1">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Direccion</th>
                <th>Acción</th>
            </tr>
            </Thead> <?php
            while($fila = mysql_fetch_assoc($query)) { 
                ?> 
                <tr>    
                    <td><?php echo $fila['usua_nomb'] ?></td>
                    <td><?php echo $fila['usua_usua'] ?></td>
                    <td><?php echo $fila['usua_mail'] ?></td>
                    <td><?php echo $fila['usua_dire'] ?></td>

                    <td> <a href="<?php echo "http://". $_SERVER['SERVER_NAME'].'/modulos/usuario/usuario_edit.php?usua_id='. $fila['usua_id']?>">Editar</a></td>
                </tr>
                <?php } ?>  
            </tbody>
        </table>
        <a href="<?php echo "http://". $_SERVER['SERVER_NAME'].'/modulos/usuario/usuario_new.php'?>">Nuevo Usuario</a>

<?php
   } 
if($usuario_tipo==2){
        echo "<p>Como usted es un usuario comun no puede ver a los demas usuarios.<p/>";
        echo "<p>Pero puede editar su propio perfil.<p/>";
        $usua_id=$_SESSION['usuario_id']; ?>
        <a href="<?php echo "usuario_edit.php?usua_id=".$usua_id ?>">Editar perfil</a>

        <?php
    }

}else{
    echo "<p>Hay que logearse(arriba a la derecha del menu). para ver a los usuarios, o editar el suyo.</p>";
}

?>

<?php include('../templates/footer.php'); ?>