<?php session_start();?>
<!DOCTYPE html>
<head>
  <title>The Cave Arts</title>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
  <link rel="stylesheet" href="css/layout.css" type="text/css" media="all" />
  <link rel="stylesheet" href="css/footer.css" type="text/css" media="all" />
  <link rel="shortcut icon" type="image/x-icon" href="css/images/favicon.ico" />
  <link rel="stylesheet" href="css/login.css" type="text/css"></link>
  <script type="text/javascript" src="js/jquery1.4.2.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.8.2.custom.min.js"></script>
  <script type="text/javascript" src="js/login.js"></script>

  <?php include('lib/connect.php') ?>
  <?php include('lib/librerias.php') ?>


  <?php
  $obj= new Seleccionar;
  
  $query= $obj->get_all('obra');
  ?>
  <script>    
  $(document).ready(function(){
        //Lo primero que hago es capturar el evento de submit es decir cuando se envia el form para 
        //evitar que se procese normalmente y lo haga por ajax
        $('#login_form').submit(function(event){
         //recupero los valores ingresados en los input con id usuario e id password
         var usuario = $('#usuario').val();
         var password =  $('#password').val();
         //controlo que no se envien vacios
         if(usuario=='' || password==''){
          alert('El Usuario no Existe');
        }else{
         $.ajax({
          type: "POST",
          url: 'modulos/login/validar.php',
          data: {usuario:usuario, password:password},
          async: false,
          dataType: "json",
          success: function(data){
            if(data.control == 1){
             return true;
           }else{
                        //con esta funcion se previene que el formulario se envie
                        event.preventDefault();
                        alert('Los Datos ingresados no son correctos.');
                      }
                    },                           
                    error: function(qhx, trownError){
                      alert(trownError);
                    }   

                  });
       }
     });
});

</script>
<!--[if IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
</head>
<body>

  <!-- START PAGE SOURCE -->

  <div class="header">
    <div id="menu">
      <img class="logo" src="img/logo.png"/>


    <!--SETEO DE USUARIO PARA CARGA DEL MENU_______ -->
    <?php
    if(isset($_SESSION['usuario_id']))
    {
      $usuario_tipo=$_SESSION['usuario_tipo'];
      if($usuario_tipo==1){
        ?>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="<?php echo "http://". $_SERVER['SERVER_NAME'].'/modulos/usuario/usuario_edit.php?usua_id='. $_SESSION['usuario_id']?>">Edit User</a></li>
          <li><a href="modulos/categoria/cate_listado.php">Category</a></li>
          <li><a href="modulos/obra/obra_new.php">Obra</a></li>
          <li><a href="modulos/usuario/usuario_listado.php">Users</a></li>
          <li><a href="modulos/venta/venta_listado.php">Sales</a></li>
          <li><a href="modulos/venta/venta_new.php">My Cart</a></li>
        </ul>
        <?php
      } 
      if($usuario_tipo==2){ ?>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="<?php echo "http://". $_SERVER['SERVER_NAME'].'/modulos/usuario/usuario_edit.php?usua_id='. $_SESSION['usuario_id']?>">Edit User</a></li>
        <li><a href="modulos/venta/venta_new.php">My Cart</a></li>
      </ul>
      <?php }

    }else{?>
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="modulos/usuario/usuario_new.php">Register</a></li>
    </ul>
    <?php }?>
    <!--SETEO DE USUARIO PARA CARGA DEL MENU_______ -->

    <?php 
    if(isset($_SESSION['usuario_nombre'])){
      ?>

      <div class="logd">
        <div id="tab-logd">
          <h2><?php echo $_SESSION['usuario_nombre']; ?></h2>
          <a href="modulos/login/logout.php">Log-Out</a>
          <a href="modulos/venta/venta_new.php">My Cart(<?php 
            if(isset($_SESSION['ventas'])){
              echo count($_SESSION['ventas']);
            }else{
              echo "0";
            }
            ?>)</a>
          </div>
        </div>
        <?php
      }else
      { ?>
      <div class="lnk">
        <a href="#" class="login_btn"><span>Login</span><div class="triangle"></div></a>
      </div>
      <div id="login_box">
        <div id="tab"><a href="..." class="login_btn"><span>Login</span><div class="triangle"></div></a></div>
        <div id="login_box_content"></div>
        <div id="login_box_content">
          <form id="login_form" action="#" method="post">
            <h2>Ingresa Tus Datos...</h2>
            <input type="text" id="usuario" placeholder="Username" />
            <input type="password" id="password" placeholder="Password" />
            <input type="submit" value="Log-In" />
          </form>
        </div>
      </div>
      <?php }?>


    </div>
  </div>
  <div class="wrapper">

    <div id="rightbar">
      <div class="comprs">   
        <a href="../../index.php"><p>Categorias!</p></a>
      </div>
      <ul id ="nav">
       <?php 
       $obj_cat= new Seleccionar;
       $query_cat= $obj_cat->get_all('categoria');         
       while($res_cat=mysql_fetch_assoc($query_cat)){ 
        ?>
        <li>
          <div class="com">  
           <a href="<?php echo "http://". $_SERVER['SERVER_NAME'].'/modulos/filtro/categoria.php?id='. $res_cat['cate_id']?>"> <?php echo $res_cat['cate_nom'] ?> </a>
         </div>  
       </li>
       <?php } ?>
     </ul>
   </div>


   <?php    
   while($fila = mysql_fetch_assoc($query)) {
    ?>   
    <div class="main">
     <ul >
       <li class="list">
        <h2><a href="<?php echo "http://". $_SERVER['SERVER_NAME'].'/modulos/obra/obra.php?id='. $fila['obra_id']?>"><?php echo $fila['obra_nomb']; ?></a></h2>
        <h2><a href="#"><?php echo $fila['obra_fech']; ?></a></h2>
        <h1>From <a href="<?php echo "http://". $_SERVER['SERVER_NAME'].'/modulos/filtro/categoria.php?id='. $fila['cate_id']?>">
          <?php
          $cate_id =$fila['cate_id'];
          $cate_ob= new Seleccionar;
          $query_cate= $cate_ob->get_one('categoria','cate_id',$cate_id);   
          $res_cate = mysql_fetch_assoc($query_cate);
          echo $res_cate['cate_nom'];
          ?>
        </a></h1>
        <a href="<?php echo "http://". $_SERVER['SERVER_NAME'].'/modulos/obra/obra.php?id='. $fila['obra_id']?>"><img WIDTH=150 HEIGHT=150 class="galler" src="<?php  echo "upload/".$fila['obra_url']; ?>"/></a>

      </li>
      <input type="hidden" id="entrada" value="<?php echo $fila['obra_id']?>"/>  
      <ul>
      </div>
      <?php } ?>  
    </div>

    <div class="footer">
      <div class="dvstand">
        <p class="pft">Contactanos en:</p>

        <ul>
          <li class="ft">
           <img class="ftimg" src="img/asd.jpg"/> 
         </li>
         <li class="ft">
           <img class="ftimg" src="img/asd.jpg"/> 
         </li>
         <li class="ft">
           <img class="ftimg" src="img/asd.jpg"/> 
         </li>
         <li class="ft">
           <img class="ftimg" src="img/asd.jpg"/> 
         </li>
         <li class="ft">
           <img class="ftimg" src="img/asd.jpg"/> 
         </li>
         <li class="ft">
           <img class="ftimg" src="img/asd.jpg"/> 
         </li>
         <li class="ft">
           <img class="ftimg" src="img/asd.jpg"/> 
         </li>
         <li class="ft">
           <img class="ftimg" src="img/asd.jpg"/> 
         </li>
       </ul>


       <div style="clear:both;"></div>
     </div>
   </div>
 </div>
 <!-- END PAGE SOURCE -->
</body>
</html>