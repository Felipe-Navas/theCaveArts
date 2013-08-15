<?php 
include("../templates/header.php");  
?>

<?php

     $obj= new Seleccionar;
    
     $id=$_GET['id']; 

     $query= $obj->get_one('obra','obra_id',$id);
     $res=mysql_fetch_assoc($query);
?>

<script>
    $(document).ready(function(){
    $("#comentario_form").submit(function(){
    var comentario=$('#comentario').val();
    var obra_id=$('#entrada').val();
    $.ajax({
    type:"POST",
    url:"/modulos/comentario/comen_insert.php",
    data:{comentario:comentario,obra_id:obra_id},
    async:false,
    dataType:"json",
    success: function(data){
      if(data.control==1){
      var new_comment="<li class='comments'><p>"+data.usuario_nombre+"</p><p>"+data.fecha+"</p><li></li><h2>"+data.comentario+"</h2></p></li>";
            $('#comentario_listado').append(new_comment);
            $('#comentario').val('');
            return false;
          }else{
            alert('Fallo comentar');
            return false;
            }
        },
        error: function(qhx, trownError){
                alert(trownError);
        }
          });
          return false;
          });
          });
            </script>



<div class="wrapper">
  <div class="cnt">
    <div id="obra">
      <a href="http://the_cave_arts.com/upload/<?php echo $res['obra_url'] ?>" ><img class="imgob" src="<?php  echo "../../upload/".$res['obra_url']; ?>" /> </a>
       <div class="pst"> 
          <p><a><?php echo $res['obra_nomb']; ?></a></p>
          <p>By - The Cave Arts!</p>
          <p>From: <a>
          <?php
           $cate_id =$res['cate_id'];
           $seleccionar_cate= $obj->get_one('categoria','cate_id',$cate_id);
           $res1=mysql_fetch_assoc($seleccionar_cate);
           echo $res1['cate_nom'];
          ?>
          </a></p>   
          <h5><?php echo $res['obra_desc']; ?></h5>
        </div>
    </div>

<!-- TERMINO DEL POST -->

 <?php 
       if(isset($_SESSION['usuario_id'])){ ?>
        <div class="usrcomt" id="leavecomment">
          <p class="ttl">Leave a Comment!</p>
          <form id="comentario_form"  action="comentario.js" method="post" name="#">
            <ul>
              <li>
                <label id="asd" for="name"><?php echo $_SESSION['usuario_user']?></label>
              </li>
              <li>
                <textarea id="comentario" class="txtcom"  cols="150" rows="6" required  class="required"></textarea>
              </li>
              <input type="hidden" id="entrada" value="<?php echo $id ?>"/>
              <li>
                <button type="submit" class="btncom">Comentar</button>
              </li>
            </ul>
          </form>
<?php } ?>  
   <div class="comment" >
       <ul class="comments" id="comentario_listado">
          <?php
               $obj_com= new Seleccionar;
               $query_com= $obj_com->get_one('comentarios','obra_id',$id);          
               while($res_com=mysql_fetch_assoc($query_com)){ ?>
         <li>
           <p>
             <?php
               $usu_id=$res_com['usua_id'];
               $obj_usu= new Seleccionar;
               $query_usu= $obj_usu->get_one('usuario','usua_id',$usu_id);          
               $res_usu=mysql_fetch_assoc($query_usu);
               echo $res_usu['usua_usua'];
             ?>
           </p>  
           <p>
            <?php 
              echo $res_com['come_fech']; 
            ?>
           </p>
           <li></li>
          </li>
           <h2><?php echo $res_com['come_cont'] ?></h2>
         </li>
       
        <?php } ?>
        </ul>
   </div> 
</div> 
<?php 
       if(isset($_SESSION['usuario_id'])){ ?> 
</div> 
 
        <?php } ?>





<div class="latbar">
  <p></p>
  <?php
  if(isset($_SESSION['usuario_id'])){
    ?>
   <div class="comprs">   
     <p>Compras!</p>
  </div>
  <ul>
      <li class="topli">Precio:</li>
      <li><h2>$<?php echo $res['obra_prec']; ?> </h2></li>        
    
    <form action="../venta/venta_new.php" method="POST">
      <input type="hidden" name="obra_id" value="<?php  echo $id ?>">
      <input type="hidden" name="imagen" value="<?php  echo '../../upload/'.$res['obra_url']; ?>">
      <input type="hidden" name="detalles" value="<?php echo "Name: ".$res['obra_nomb']."<br>Categoria: ".$res1['cate_nom']."<br>Descripcion: ".$res['obra_desc']; ?>">
      <input type="hidden" name="precio" value="<?php echo $res['obra_prec']; ?>">
      <button type="submit" id="submit" name="submit" class="btn_add">+ Add to Cart</button>

      </ul>
    </form>
    <?php
  }else{
   ?>
   <p>Compras!</p>
   <ul>
    <li>Debe Logearse para comprar</li>
    <br>
    <br>
  </ul>
  <?php } ?>
</div>
</div>
</body>
<?php 
include("../templates/footer.php") ?>