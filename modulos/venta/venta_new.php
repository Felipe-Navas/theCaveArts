<link rel="stylesheet" href="../../../css/venta.css" type="text/css" media="all" />
<?php include('../templates/header.php') ?>

<!-- Row Highlight Javascript -->
<script type="text/javascript">
window.onload=function(){
	var tfrow = document.getElementById('tfhover').rows.length;
	var tbRow=[];
	for (var i=1;i<tfrow;i++) {
		tbRow[i]=document.getElementById('tfhover').rows[i];
		tbRow[i].onmouseover = function(){
			this.style.backgroundColor = '#ffffff';
		};
		tbRow[i].onmouseout = function() {
			this.style.backgroundColor = '#e74c3c';
		};
	}
};
</script>



<script>
// function actualizar_subtotal(precio,cantidad){
// 	subtot.value = precio * cantidad;
// }
</script>

<p class="pagetittle">My Cart</p>
<a href="../../../index.php">&lt;&#45;&nbsp;Continue Shopping </a>
<table id="tfhover" class="tftable" border="1">
	<tr><th>Image</th><th>Details</th><th>Price</th></tr>


	

	<?php
	$total=0;

	if((isset($_POST['imagen'])) AND (isset($_POST['detalles'])) AND (isset($_POST['precio']))){
		if(!isset($_SESSION['ventas'][1])){
			$_SESSION['ventas'] = array();
		}
		$total=0;
		$image=$_POST['imagen'];
		$imagen="<img WIDTH=100 HEIGHT=100 src='".$image."'";
		$detalles=$_POST['detalles'];
		$precio=$_POST['precio'];
		$obra_id=$_POST['obra_id'];
		#$cantidad="<input type='text' value='1' onKeyUp='actualizar_subtotal(".$precio.",this.value);'/>";
		#$subtotal="<input type='text' id='subtot' value='".$precio."' readonly>";
		$indice = count($_SESSION['ventas']) + 1;
		$_SESSION['ventas'][$indice]['obra_id']=$obra_id;
		$_SESSION['ventas'][$indice]['imagen']=$imagen;
		$_SESSION['ventas'][$indice]['detalle']=$detalles;
		$_SESSION['ventas'][$indice]['precio']=$precio;
		#$_SESSION['ventas'][$indice]['cantidad']=$cantidad;
		#$_SESSION['ventas'][$indice]['subtotal']=$subtotal;
	}
	if(isset($_SESSION['ventas'][1])){
		foreach ($_SESSION['ventas'] as $value) { ?>
		<tr>
			<?php
			echo "<td>".$value['imagen']."</td>"; 
			echo "<td>".$value['detalle']."</td>";			
			echo "<td>$".$value['precio']."</td>"; 
			$total=$total+$value['precio'];
			echo "</tr>"; 
		} ?>
		
		<?php
	}
	?>
	<tr><th>Total</th><th></th><th><?php echo "$".$total ?></th></tr>
</table>
<a href="../../../index.php">&lt;&#45;&nbsp;Continue Shopping </a>

<form action="venta_insert.php" method="POST">
	<input type="hidden" name="importe" value="<?php echo $total; ?>">
	<button type="submit" id="submit" name="submit" class="btn_add">Checkout Now</button>
</form>

<?php include('../templates/footer.php') ?>