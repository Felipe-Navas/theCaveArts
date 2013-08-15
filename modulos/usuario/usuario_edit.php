<?php
//Al incluir el head ya estoy icluyendo la conexion y las librerias
include('../templates/header.php')
?>

<script type="text/javascript">
$(document).ready(function(){
  cargar_comunidades();
  $("#comunidad").change(function(){dependencia_provincia(); $("#localidad").attr("disabled",true);});
  $("#provincia").change(function(){dependencia_localidad();});
  $("#provincia").attr("disabled",true);
  $("#localidad").attr("disabled",true);
});

function cargar_comunidades()
{
  $.get("scripts/cargar-comunidades.php", function(resultado){
    if(resultado == false)
    {
      alert("Error");
    }
    else
    {
      $('#comunidad').append(resultado);
    }
  }); 
}
function dependencia_provincia()
{
  var code = $("#comunidad").val();
  $.get("scripts/dependencia-provincias.php", { code: code },
    function(resultado)
    {
      if(resultado == false)
      {
        alert("Error");
      }
      else
      {
        $("#provincia").attr("disabled",false);
        document.getElementById("provincia").options.length=1;
        $('#provincia').append(resultado);      
      }
    }

    );
}

function dependencia_localidad()
{
  var code = $("#provincia").val();
  $.get("scripts/dependencia-localidades.php?", { code: code }, function(resultado){
    if(resultado == false)
    {
      alert("Error");
    }
    else
    {
      $("#localidad").attr("disabled",false);
      document.getElementById("localidad").options.length=1;
      $('#localidad').append(resultado);      
    }
  }); 

}
</script>

<?php
$usuario_id=$_GET['usua_id'];
$datos_usuario=mysql_query("Select* from usuario where usua_id=$usuario_id ");
$resultado=mysql_fetch_assoc($datos_usuario);

?>

<p class="pagetittle">Modificar Datos</p>

<form action="../../lib/update.php" method="post" name="form_pass" onSubmit="return validar_password()"> 
  <ul>
    <li>
      <label>Nombre:</label>
      <input type="text" name="array[]" value="<?php echo $resultado['usua_nomb'] ?>" required class="required" >
    </li>             
    <li>
      <label>Sexo:</label>
      <select name="array[]" value="<?php echo $resultado['usua_sexo'] ?>">
        <option value="0"  required class="required" >Femenino</option>
        <option value="1"  required class="required" >Masculino</option>
      </select>
      
      <label>Pais:</label>
      <li>
        <select name="com_id" id="comunidad">
          <option value="0">Selecciona un pais</option>
        </select>
      </li>

      <label>Provincia:</label>
      <li>
        <select name="prov_id" id="provincia">
          <option value="0">Selecciona una provincia</option>
        </select>
      </li>

      <label>Localidad:</label>
      <li>
        <select name="array[]" id="localidad">
          <option value="0">Selecciona una localidad</option>
        </select>
      </li>

      <li>
        <label>Direccion:</label>
        <input type="text" value="<?php echo $resultado['usua_dire'] ?>" name="array[]"required class="required" >
      </li>
      <label for="email">Email:</label>
      <input type="email" name="array[]" value="<?php echo $resultado['usua_mail'] ?>" required placeholder="Ejemplo@gmail.com" class="required email">
    </li>
    <li>
      <label for="name">Usuario:</label>
      <input type="text" name="array[]" value="<?php echo $resultado['usua_usua'] ?>" required class="required" >
    </li>
    <li>
      <label for="name">Contraseña:</label>
      <input type="password" name="password1" required class="required" >
      <input type="password" name="password2" required placeholder="Repetir contraseña" class="required" >
      <input type="hidden" id="password" name="array[]" >
    </li>
    <li>
      <label for="name">Tipo de Usuario:</label>
      <?php echo crearCombo("tipo_usuario", "tipo_id","tipo_nomb","array[]");?>
    </li>
    <input type="hidden" name="tabla" value="usuario">
    <input type="hidden" name="id" value="<?php echo $resultado['usua_id'] ?>"/>

    <li>
      <button type="submit" id="submit" name="submit">Modificar</button>
    </li> 
  </ul>     
</form>
<?php include('../templates/footer.php')?>
