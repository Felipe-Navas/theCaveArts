<?php include('../templates/header.php'); 

if(isset($_SESSION['usuario_id']))
{
	$usuario_tipo=$_SESSION['usuario_tipo'];
	if($usuario_tipo==1){
		?>
		<p class="pagetittle">Nueva Categoria</p>
		<form action="../../lib/insertar.php" method="post" name="form_usuario" >	

			<ul>
				<li>
					<label>Nombre:</label>
					<input type="text" name="array[]" required class="required" >
				</li>             
				<li>
					<label>Descripcion:</label>
					<textarea name="array[]"></textarea>
				</li>
				<input type="hidden" name="tabla" value="categoria">
				<li>
					<button type="submit" id="submit" name="submit" class="button fright">Crear</button>
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

include('../templates/footer.php');?>