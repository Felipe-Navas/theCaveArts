 <?php 
 include('../templates/header.php'); 
 ?>


 <script>
 $(function() {
      // Botón para subir la firma
      var btn_firma = $('#addImage'), interval;
      new AjaxUpload('#addImage', {
        action: '../../lib/uploadFile.php',
        onSubmit : function(file , ext){
          if (! (ext && /^(jpg|png)$/.test(ext))){
            // extensiones permitidas
            alert('Sólo se permiten Imagenes .jpg o .png');
            // cancela upload
            return false;
          } else {
            $('#loaderAjax').show();
            btn_firma.text('Espere por favor');
            this.disable();
          }
        },

        onComplete: function(file, response){

          // alert(response);
          
          btn_firma.text('Cambiar Imagen');
          
          respuesta = $.parseJSON(response);

          if(respuesta.respuesta == 'done'){
            $('#fotografia').removeAttr('scr');
            $ruta=respuesta.fileName;
            $('#fotografia').attr('src','../../upload/' + $ruta);

            $('#ruta_img').removeAttr('value');
            $('#ruta_img').attr('value', $ruta);

            $('#loaderAjax').show();
            // alert(respuesta.mensaje);
          }
          else{
            alert(respuesta.mensaje);
          }

          $('#loaderAjax').hide();  
          this.enable();  
        }
      });
});
 </script>

 <?php
 if(isset($_SESSION['usuario_id']))
 {
  $usuario_tipo=$_SESSION['usuario_tipo'];
  if($usuario_tipo==1){
    ?>
    <p class="pagetittle">Nueva Obra</p>
    <form action="../../lib/insertar.php" method="post" >

      <ul>
        <li>
          <div id="contenedorImagen">
          <img id="fotografia" class="fotografia" src="../../img/noimg.png">
          <br>
          <button class="boton" id="addImage">Cambiar Imagen</button>
          <br>
          <br>
        <li>
          <label>Titulo Obra:</label>
          <input type="text" name="array[]" required class="required" >
        </li>             
        <li>
          <label>Descripcion:</label>
          <textarea name="array[]"></textarea>
        </li>
        <li>
          <label>Precio:</label>
          <input type="text" name="array[]" required class="required" >
        </li>
           <input id='ruta_img' type="hidden" name="array[]" value="">
         </div>
         
       </li>
       <li>
         <?php $fecha=DATE('y/m/d'); ?>
         <input type="hidden" name="array[]" value="<?php echo $fecha ?>">
       </li>
       <li>
        <label for="name">Categoria:</label>
        <?php echo crearCombo("categoria", "cate_id","cate_nom","array[]");?>
      </li>
      <input type="hidden" name="tabla" value="obra">
      <li>
        <br>
       <button type="submit" id="submit" name="submit">Subir Obra</button>
     </li> 

   </ul>  

 </form>

   <?php
 } 
 if($usuario_tipo==2){
  echo "<p>Como usted es un usuario comun no puede agregar una nueva obra.<p/>";
  echo "<p>Solo tiene permisos el administrador.<p/>";



}

}else{
  echo "<p>Hay que logearse(arriba a la derecha del menu). para agregar una nueva obra.</p>";
}

include('../templates/footer.php');
?>
