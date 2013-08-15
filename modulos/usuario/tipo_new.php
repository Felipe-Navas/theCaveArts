 <?php include('../templates/header.php'); ?>

<?php if(isset($_SESSION['usuario_id']))
 {
    $usuario_tipo=$_SESSION['usuario_tipo'];
    if($usuario_tipo==1){
     ?> 

<p class="pagetittle">Nuevo Tipo de Usuario</p>

<form action="../../lib/insertar.php" method="post">	
	<ul>
		<li>
			<label>Nombre:</label>
			<input type="text" name="array[]" required class="required" >
		</li>
		<li>
			<label for="name">Descripcion:</label>
			<textarea rows="4" cols="50" name="array[]"></textarea>
		</li>
			<input type="hidden" name="tabla" value="tipo_usuario">
		<li>
			<button type="submit" id="submit" name="submit">Registrarse</button>
		</li>	
	</ul>			
</form>
<?php }else{ ?>
<h2>Usted tiene que ser un usuario de tipo Administrador para agregar un tipo de usuario nuevo.</h2>
<?php
} 

}else{?> 

<h2>Usted debe logearse para acceder a esta seccion del sistema(arriba a la derecha del menu).</h2>

<?php } ?> 

<?php include('../templates/footer.php');?>


